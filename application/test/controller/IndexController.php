<?php
namespace app\test\controller;

class IndexController
{



    public function testAction(){
        
        //1.将timestamp,nonce,token按字典序排序
        $timestamp = $_GET['timestamp'];

        $nonce = $_GET['nonce'];

        $token = 'zhgs';

        $signature = $_GET['signature'];

        $array = array($timestamp,$nonce,$token);

        sort($array);

        //2.将排序后的三个参数拼接之后用sha1加密
        $tmpstr = implode('', $array);//join

        $tmpstr = sha1($tmpstr);

        //3.将加密后的字符串与signature进行对比，判断该请求是否来自微信
        if($tmpstr == $signature){

        	echo $_GET['echostr'];

        	exit;
        }

    }

//获取access_token
    public function accessAction(){     

        //定义一个APPID的常量
        define('APP_ID','wx9e1d8fc5ee0c85a1');

        //定义一个APPSECRET的常量
        define('APP_SECRET','39ea8dc418b5ab3a03867a5937fe19fd'); 

        //使用CURL向腾讯的API接口中发送对应的请求
        $ch = curl_init();

        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APP_ID.'&secret='.APP_SECRET;

        curl_setopt($ch,CURLOPT_URL,$url);

        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        curl_setopt($ch,CURLOPT_HEADER,1);

        curl_setopt($ch,CURLOPT_TIMEOUT,10);

        $output = curl_exec($ch);

        var_dump($output);

        
        //得到access_token（票据）
        //
        //将其保存起来
    }
       

}