<?php
namespace app\test\controller;

use think\Controller;
class IndexController extends Controller {
    protected function _initialize()
    {

        //$this->log('__construct');
    }

	/*private function log($str){
	    $filename = time().'.txt';
	    @file_put_contents('./'.$filename , $str .PHP_EOL.PHP_EOL,FILE_APPEND);
	}*/
	public function indexAction(){
/* 	    //$this->log(11);

        $this->log('__construct');
    }

	private function log($str){
	    $filename = time().'.txt';
	    @file_put_contents('./'.$filename , $str .PHP_EOL.PHP_EOL,FILE_APPEND);
	}
	public function indexAction(){
	    $this->log(11);

	    //$this->log($GLOBALS['HTTP_RAW_POST_DATA']);
	    
		//获得参数 signature nonce token timestamp echostr
		$nonce     = $_GET['nonce'];
		var_dump($nonce);
		$token     = 'zhgs';
		$timestamp = $_GET['timestamp'];
		$echostr   = $_GET['echostr'];
		$signature = $_GET['signature'];
		//形成数组，然后按字典序排序
		$array = array();
		$array = array($nonce, $timestamp, $token);
		sort($array);
		//拼接成字符串,sha1加密 ，然后与signature进行校验
		$str = sha1( implode( $array ) );
		if( $str  == $signature && $echostr ){

		    //$this->log(22);

		    $this->log(22);

			//第一次接入weixin api接口的时候
			echo  $echostr;
			exit;
		}else{

		    //$this->log(33); */
			$this->reponseMsgAction();
/* 		} */
	}

	}
	
	// 接收事件推送并回复
	public function reponseMsgAction(){
		//1.获取到微信推送过来post数据（xml格式）
		$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
		$tmpstr  = $postArr;
		//2.处理消息类型，并设置回复类型和内容
		$postObj = simplexml_load_string( $postArr );
		//$postObj->ToUserName = '';
		//$postObj->FromUserName = '';
		//$postObj->CreateTime = '';
		//$postObj->MsgType = '';
		//$postObj->Event = '';
		// gh_e79a177814ed
		//判断该数据包是否是订阅的事件推送
		if( strtolower( $postObj->MsgType) == 'event'){
		    
			//如果是关注 subscribe 事件
			if( strtolower($postObj->Event == 'subscribe') ){
			   
				//回复用户消息(纯文本格式)	
				$toUser   = $postObj->FromUserName;
				$fromUser = $postObj->ToUserName;
				$time     = time();
				$msgType  = 'text';

				$content  = '欢迎关注智慧高速MPS'.PHP_EOL.'OpenID为：'.$postObj->FromUserName;

				$content  = '欢迎关注公众帐号'.$postObj->FromUserName.'-'.$postObj->ToUserName;

				$template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				$info     = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				echo $info;

				exit();		

			}
		}
	}

}//class end
