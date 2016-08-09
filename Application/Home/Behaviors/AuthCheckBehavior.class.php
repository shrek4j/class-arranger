<?php
namespace Home\Behaviors;
class AuthCheckBehavior extends \Think\Behavior{
    //行为执行入口
    public function run(&$return){
        $uri = $_SERVER["REQUEST_URI"];
        if(strpos($uri,'/Operator/login') || strpos($uri,'/Operator/doLogin') 
            || strpos($uri,'/Captcha/startCaptcha') || strpos($uri,'/Captcha/verifyCaptcha')
            || strpos($uri,'/Operator/showRegisterInstruction') || strpos($uri,'/Operator/showRegister') 
            || strpos($uri,'/Operator/checkLoginname') || strpos($uri,'/Operator/doRegister')
            || strpos($uri,'/Operator/registerDone')){//在这里写列表，可以不做检查
            $return = true;
        }else{
            $operatorId = session('operatorId');
            if(!empty($operatorId)){
                $return = true;
            }else{
                 header('Content-Type: text/html; charset=utf-8');
                 redirect('../Operator/login', 2, '需要登录，2秒后跳转。。。');
            }
        }
    }
}