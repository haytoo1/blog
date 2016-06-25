<?php

class HttpServer
{
    public static $instance;

    public $http;
    public static $get;
    public static $post;
    public static $header;
    public static $server;
    private $application;

    public function __construct() {
        $http = new swoole_http_server("0.0.0.0", 9501);

        $http->set(
            array(
                'worker_num' => 4,
                'daemonize' => false,
                'max_request' => 1000,
//                'dispatch_mode' => 1
            )
        );

        $http->on('WorkerStart' , array( $this , 'onWorkerStart'));

        $http->on('request', function ($request, $response) {
            if( isset($request->server) ) {
                HttpServer::$server = $request->server;
                foreach ($request->server as $key => $value) {
                    $_SERVER[ strtoupper($key) ] = $value;
                }
            }
            if( isset($request->header) ) {
                HttpServer::$header = $request->header;
            }
            if( isset($request->get) ) {
                HttpServer::$get = $request->get;
                foreach ($request->get as $key => $value) {
                    $_GET[ $key ] = $value;
                }
            }
            if( isset($request->post) ) {
                HttpServer::$post = $request->post;
                foreach ($request->post as $key => $value) {
                    $_POST[ $key ] = $value;
                }
            }
            /*
			$uri = explode( "?", $_SERVER['REQUEST_URI'] );
			$_SERVER["PATH_INFO"] = $uri[0];
			if( isset( $uri[1] ) ) {
				$_SERVER['QUERY_STRING'] = $uri[1];
			}*/
            $_SERVER['argv'][1]=$_SERVER["PATH_INFO"];
            ob_start();

//            require_once './ThinkPHP/ThinkPHP.php';



            require(__DIR__ . '/../../../vendor/autoload.php');
            require(__DIR__ . '/../../../vendor/yiisoft/yii2/Yii.php');
            require(__DIR__ . '/../../../common/config/bootstrap.php');
            require(__DIR__ . '/../../config/bootstrap.php');

            $config = yii\helpers\ArrayHelper::merge(
                require(__DIR__ . '/../../../common/config/main.php'),
                require(__DIR__ . '/../../config/main.php')
            );
            (new yii\web\Application($config))->run();







            $result = ob_get_flush();

            $response->end($result);
        });

        $http->start();
    }

    public function onWorkerStart() {
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        defined('YII_ENV') or define('YII_ENV', 'dev');

    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new HttpServer;
        }
        return self::$instance;
    }
}

HttpServer::getInstance();