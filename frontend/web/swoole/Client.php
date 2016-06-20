<?php
/**
 * User: 涂鸿<hayto@foxmail.com>
 * Date-Time: 2016/6/17 14:48
 */
/*class Client
{
    private $client;

    public function __construct() {
        $this->client = new swoole_client(SWOOLE_SOCK_TCP);
    }

    public function connect() {
        if( !$this->client->connect("127.0.0.1", 9501 , 1) ) {
            echo "Error: {$fp->errMsg}[{$fp->errCode}]\n";
        }
        $message = $this->client->recv();
        echo "Get Message From Server:{$message}\n";

        fwrite(STDOUT, "请输入消息：");
        $msg = trim(fgets(STDIN));
        $this->client->send( $msg );
    }
}

$client = new Client();
$client->connect();*/
/*$cmdstr = <<<CMD
            [cn]
            <?xml version="1.0" encoding="UTF-8" standalone="no"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
  <command>
    <info>
      <obj:info xmlns:obj="urn:ietf:params:xml:ns:obj">
        <!-- Object-specific elements. -->
      </obj:info>
    </info>
    <clTRID>ABC-12346</clTRID>
  </command>
</epp>\r\n
.
CMD;
echo $cmdstr;die;


*/
$data = "dddddd";

if(($socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false){
    throw new Exception('socket_create_error: '. socket_strerror(socket_last_error()));
}
if((socket_connect($socket, '127.0.0.1', 9501)) === false){
    throw new Exception('socket_connect_error: '. socket_strerror(socket_last_error()));
}

//$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
//$conn = socket_connect($socket, '127.0.0.1', 9501);
socket_write($socket, $data, strlen($data));
$res = '';
while ($temp = socket_read($socket, 4)){
//    $res .= $temp;
    var_dump($temp);
    /*if(!$temp){
        socket_close($socket);
        break;
    }*/
//    socket_close($socket);
//    break;
}
//socket_close($socket);
//var_dump($res);

