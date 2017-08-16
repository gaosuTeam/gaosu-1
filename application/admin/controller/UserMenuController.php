<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\SysUserMenu;
use app\admin\validate\UserMenuValidate;

class UserMenuController extends Controller
{
    use  \app\common\trait_common\RestTrait;
   protected function _before_save(){
        return [
            'modelname'=>'\\'.SysUserMenu::class,
            'allowField'=>['user_id','menu_id','allow'],
            'validate'=>new UserMenuValidate(),
        ];
    }
    
    protected function _before_update(){
        return [
            'modelname'=>'\\'.SysUserMenu::class,
            'allowField'=>['user_id','menu_id','allow'],
            'validate'=>new UserMenuValidate(),
        ];
    }
    
    protected function _before_delete(){
        return [
            'modelname'=>'\\'.SysUserMenu::class,
        ];
    }
}
