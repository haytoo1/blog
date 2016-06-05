<?php
/**
 * Created by PhpStorm.
 * Date: 16/6/4
 * Time: 11:30
 * @author 涂鸿 <hayto@foxmail.com>
 */

namespace console\controllers;

use common\toolkit\CustomException;
use yii;
/*
 * 安装gearman扩展实现优雅的ping,这里不用,牛刀.
 * 使用SplFileObject操作csv
 * */
class UpdateinfoController extends  yii\console\Controller
{
    public $filePath = '../info.csv';
    public function actionIndex()
    {
        /*读旧csv文件*/
        $sourceFileObj = new \SplFileObject($this->filePath);
        $sourceFileObj->setFlags(\SplFileObject::READ_CSV);

        /*写新csv文件*/
        $destinFileObj = new \SplFileObject('../ok.csv', 'w+');

        /*一行一行处理*/
        foreach($sourceFileObj as $k=>$v){
            if($k == 57){
                break;
            }
            echo $k,PHP_EOL;
            try{
                /*两行标题不处理,直接写入新文件*/
                if($k < 2){
                    $v[14] = mb_convert_encoding('状态', 'gbk', 'utf8');
                    throw new CustomException();
                }
                // 1,有域名的话,用Ping获取ip地址
                if(!empty($v[4])){
                    if(($ip = $this->Ping('www.'.$v[4])) === false){
                        if(($ip = $this->Ping($v[4])) === false){
                            // ping不通,直接加状态
                            // 修改$v
                            $v[14] = mb_convert_encoding('ping不通', 'gbk', 'utf8');
                            throw new CustomException();
                        }
                    }
                    // 2,用ip地址加txt判断是否是绵阳的
                    $companyName = $this->isMianYang($ip);

                    // 2.1,不是绵阳就调用api获取地址,并
                    if($companyName === false){
                        /*调用api获得地址*/
                        $addrString = $this->getInfoFromIp($ip);
                        // 修改$v 不在绵阳
                        $v[14] = $addrString;
                        throw new CustomException();
                    }
                    // 2.2 在绵阳,又分两种情况
                    if(strpos($companyName, '西部数码') !== false){
                        // todo 更新资料 修改$v
                        $v[14] = mb_convert_encoding('我司的', 'gbk', 'utf8');
                        throw new CustomException();
                    }else{
                        $v[14] = $companyName;
                        throw new CustomException();
                    }
                }else{
                    $v[14] = mb_convert_encoding('没有域名', 'gbk', 'utf8');
                    throw new CustomException();
                }
            }catch(CustomException $e){
                /*统一写入新csv文件*/
                $destinFileObj->fputcsv($v);
            }
        }
    }

    private function getInfoFromIp($ip=null){
        $url = 'http://apis.baidu.com/apistore/iplookupservice/iplookup?ip='.$ip;
        /*构造请求*/
        $header = [
            'http'=>[
                'header'=>'apikey: cb53c581fce6c1304d7d4bcb3a5cbe77'
            ]
        ];
        $header = stream_context_create($header);
        $resultArr = yii\helpers\Json::decode(file_get_contents($url, false, $header));
        /*处理返回的结果*/
        if(isset($resultArr['errNum']) && ($resultArr['errNum'] ===0) ){
            $result = $resultArr['retData']['country']. $resultArr['retData']['province']. $resultArr['retData']['city']. $resultArr['retData']['district'];
            return mb_convert_encoding($result, 'gbk', 'utf8');
        }
        return false;

    }
    /**
     * 通了返回ip,不通返回false
     * @param $domain
     * @return String | false
     * @author 涂鸿 <hayto@foxmail.com>
     */
    private function Ping($domain)
    {
        exec('ping -W3 -c1 '.$domain, $output);
        if(isset($output[1])){
            if(strpos($output[1], ' time=') !== false){
                return trim(explode(' ', $output[0])[2], '()');
            }
        }
        return false;
    }

    /**
     * 是绵阳的ip,就返回公司名,否则false
     * @param $ip
     * @return bool|string
     * @author 涂鸿 <hayto@foxmail.com>
     */
    private function isMianYang($ip)
    {
        $ip = ip2long($ip);
        foreach($this->Ips() as $k=>$v){
            foreach($v as $k1=>$v1){
                if(($ip >= ip2long($v1[0])) && ($ip <= ip2long($v1[1]))){
                    $companyName = mb_convert_encoding($k, 'gbk', 'utf8');
                    return $companyName;
                }
            }
        }
        return false;
    }

    /**
     * 所有已知的ip
     * @return array
     * @author 涂鸿 <hayto@foxmail.com>
     */
    private function Ips()
    {
        return [
            '世纪东方'=>[
                ['118.123.8.1','118.123.8.255'],
                ['125.65.77.130','125.65.77.255'],
                ['118.123.12.1','118.123.12.130'],
                ['125.65.112.1','125.65.112.255'],
                ['125.65.46.130','125.65.46.255'],
            ],
            '世纪东方托管到电信的ip'=>[
                ['61.139.126.190', '61.139.126.190'],
                ['61.139.126.180', '61.139.126.180'],
                ['118.123.5.29', '118.123.5.29'],
                ['118.123.10.125', '118.123.10.125'],
                ['118.123.10.120', '118.123.10.120'],
                ['118.123.13.10', '118.123.13.14'],
                ['118.123.13.29', '118.123.13.29'],
            ],
            '人文网'=>[
                ['125.65.42.0', '125.65.42.129'],
                ['125.65.111.150', '125.65.111.164'],
                ['118.123.15.128', '118.123.15.225'],
            ],
            '金泰网'=>[
                ['118.123.5.0', '118.123.5.255'],
                ['118.123.10.0', '118.123.10.40'],
                ['118.123.10.42', '118.123.10.89'],
                ['118.123.10.91', '118.123.10.128'],
                ['125.65.45.0', '125.65.45.255'],
            ],
            '商众联'=>[
                ['61.157.96.0', '61.157.96.255'],
                ['61.188.38.0', '61.188.38.255'],
            ],
            '微云'=>[
                ['125.65.79.0', '125.65.79.255'],
                ['118.123.3.0', '118.123.3.255'],
                ['125.65.44.0', '125.65.44.255'],
            ],
            '指南针'=>[
                ['61.188.87.64', '61.188.87.127'],
                ['61.188.37.1', '61.188.37.63'],
                ['118.123.9.0', '118.123.9.255'],
                ['118.123.14.128', '118.123.14.255'],
                ['125.65.46.0', '125.65.46.127'],
                ['125.65.109.0', '125.65.109.255'],
                ['125.65.111.0', '125.65.111.127'],
                ['220.166.63.0', '220.166.63.63'],
                ['125.65.78.0', '125.65.78.24'],
            ],
            '火山'=>[
                ['118.123.6.0', '118.123.6.255'],
                ['118.123.11.0', '118.123.11.255'],
                ['118.123.19.0', '118.123.19.255'],
                ['125.65.110.0', '125.65.110.255'],
            ],
            '西部数码'=>[
                ['61.139.126.0', '61.139.126.128'],
                ['61.139.126.192', '61.139.126.255'],
                ['220.166.64.32', '220.166.64.255'],
                ['125.65.76.32', '125.65.76.63'],
                ['125.65.113.0', '125.65.113.128'],
                ['118.123.10.128', '118.123.10.255'],
                ['118.123.21.0', '118.123.21.128'],
                ['118.123.16.0', '118.123.16.63'],
                ['118.123.16.96', '118.123.16.128'],
                ['61.188.37.160', '61.188.37.255'],
                ['61.188.39.0', '61.188.39.255'],
                ['118.123.7.0', '118.123.7.255'],
                ['118.123.13.128', '118.123.13.255'],
                ['118.123.15.0', '118.123.15.125'],
                ['118.123.20.0', '118.123.20.255'],
                ['118.123.13.32', '118.123.13.64'],
                ['118.123.16.128', '118.123.16.255'],
                ['118.123.17.0', '118.123.17.255'],
                ['125.65.108.0', '125.65.108.255'],
                ['118.123.18.0', '118.123.18.255'],
                ['118.123.22.0', '118.123.22.255'],
                ['118.123.21.128', '118.123.21.255'],
                ['118.123.14.0', '118.123.14.128'],
                ['125.65.82.0', '125.65.82.255'],
                ['125.65.83.0', '125.65.83.255'],
                ['118.123.4.128', '118.123.4.255'],
                ['125.65.76.0', '125.65.76.32'],
                ['125.65.113.192', '125.65.113.255'],
                ['125.65.41.0', '125.65.41.255'],
            ]
        ];
    }
}