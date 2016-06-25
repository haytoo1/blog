<?php
/**
 * User: 涂鸿<hayto@foxmail.com>
 * Date-Time: 2016/6/17 14:47
 */

class Server
{
    private $serv;

    public function __construct()
    {
        $this->serv = new swoole_server('0.0.0.0', 9501);
        $this->serv->set([
            'worker_num' => 8,
            'daemonize' => false,
            'max_request' => 10000,
            'dispatch_mode' => 2,
            'task_work_num' => 8
        ]);
        $this->serv->on('Start', [$this, 'onStart']);
        $this->serv->on('Connet', [$this, 'onConnect']);
        $this->serv->on('Receive', [$this, 'onReceive']);
        $this->serv->on('Close', [$this, 'onClose']);
        //
        $this->serv->on('Task', [$this, 'onTask']);
        $this->serv->on('Finish', [$this, 'onFinish']);
        $this->serv->start();
    }

    private function onStart($serv){
        echo 'Start{\r\n}';
    }
    private function onConnect($serv, $fd, $from_id){
        echo "Client {$fd} connect{\r\n}";
    }
    private function onClose($serv, $fd, $from_id){
        echo "Cilent {$fd} close connection \r\n";
    }
    // 收到来自客户端的数据
    private function onReceive(swoole_server $serv, $fd, $from_id, $data){
        echo "Get Message From Client {$fd}:{$data}\r\n";

        $data = [
            'task'=>'task_1', // 任务名称
            'params'=>$data, // 数据
            'fd'=>$fd // 客户端标示符
        ];
        $serv->task(json_encode($data, true)); // 投递任务,json格式化因为只能传递字符串
    }

    private function onTask($serv, $task_id, $from_id, $data){
        echo "This Task {$task_id} from worker {$from_id} \r\n";
        echo "Data: {$data} \r\n";

        $data = json_decode($data);
        echo "Receive Tash: {$data['task']}";
        var_dump($data['params']);
        $serv->send($data['fd'], 'Hello Task');// 通过客户端描述符,给客户端返回信息
        return "Finish"; // 告诉worker进程finish
    }
    private function onFinish($serv, $task_id, $data){
        echo "Task {$task_id} finish \r\n";
        echo "Result: {$data}\r\n";
    }
}
$server = new Server();