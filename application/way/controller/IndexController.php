<?php

namespace app\way\controller;

use think\Controller;
use think\Session;
use weixin\auth\AuthExtend;
use app\way\controller\func\InitFunc;
use app\way\controller\func\UserBindCarFuncController;
use app\common\model\WayUserBindCar;
use think\Url;
use think\Build;
/**
 * @deprecated 此类可删除
 * @author Administrator
 *
 */
class IndexController extends Controller
{
    public function __construct($request=null){
        parent::__construct($request);
        Session::boot();
    }
    
    /**
     * @deprecated
     * @return string
     */
    public function readAction(){
        return '123';
    }
    
    /**
     * @deprecated
     * @param string $id
     */
    public function indexAction($id=''){
        
        echo '<meta name="viewport" content="width=device-width, initial-scale=1" />';
        dump($_SESSION);
        
        Build::module('admin');
        
        $arr = [];
        $arr['初始化config表数据'] = url('way/index/initconfig');
        $arr['测试创建用户车辆二维码'] = url('way/index/testQrcode');
        $arr['获取access_token'] = url('way/index/testAccess_token');
    
    
        foreach ($arr as $text=>$link){
            echo "<a target='_blank' href='{$link}'>{$text}</a><br /><br />";
        }
        
        dump($id);
        
        dump($this->request->get());
    }
    
    public function testQrcodeAction(){
        $func = new UserBindCarFuncController();
        
        $wayUserBindCar = WayUserBindCar::get(1);
        $base_path = $func->createQrcode($wayUserBindCar);
        
        
        for ($i=0;$i<1;$i++){
            $root_url = str_replace('/index.php', '', $this->request->root());
            $path = str_replace('\\', '/', $base_path);
            $path = $root_url.'/'.$path;
        }
        
//         dump(get_defined_constants());

        return "<img src= '{$path}' />";
        
    }
    
    public function initConfigAction(){
        $init = new InitFunc();
        dump($init->initConfig());
        
    }
    
    public function testAccess_tokenAction(){
        $auth = new AuthExtend();
        dump($auth->getAccessToken());
    }
    
    
    public function clearFileAction(){
        $dir = [
          ROOT_PATH.'public/tmp_tool',
        ];
        
        $dir = new \DirectoryIterator(ROOT_PATH.'public/tmp_tool');
        foreach ($dir as $k=>$v){
            dump($v);
        }
        dump($dir->read());
        dump($dir->read());
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
}
