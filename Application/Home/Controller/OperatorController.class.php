<?php
namespace Home\Controller;
use Think\Controller;
class OperatorController extends Controller {
    // entrance:   http://localhost/index.php/Home/Operator/login
    public function login(){
        if(session("loginErr")==1){
            $this->assign("login_msg","用户名或密码错误！");
        }
        $this->display();
    }
    
    public function logout(){
        session('operatorId', null);
        session('instId', null);
        $this->redirect('Operator/login', null,0, '页面跳转中...');
    }
    
    public function doLogin($loginname,$password){
        if(session('can_doLogin') != true){
            echo "fuck off!";
            return;
        }
        session('can_doLogin',false);
        $operator = new \Home\Model\OperatorModel();
        $result = $operator->queryOperator($loginname,$password);
        if(!empty($result) && count($result) == 1){
            session('operatorId',$result[0]['operator_id']);
            session('instId',$result[0]['inst_id']);
            session('operatorName',$result[0]['user_name']);
            session('role',"管理员");

            $unknown = 'unknown';  
            if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] 
                && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
            } elseif ( isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] 
                && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {  
                $ip = $_SERVER['REMOTE_ADDR'];  
            }  
            /*  
            处理多层代理的情况  
            或者使用正则方式：$ip = preg_match("/[d.]
            {7,15}/", $ip, $matches) ? $matches[0] : $unknown;  
            */  
            if (false !== strpos($ip, ',')){
                $ip = reset(explode(',', $ip)); 
            }

            //add login log
            $operator->addLoginLog($result[0]['operator_id'],date('Y-m-d H:i:s',time()),$ip);
            session("loginErr",0);
            $this->redirect('Class/showClassList?nav=44&pnav=40', null,0, '页面跳转中...');
        }else{
            session("loginErr",1);
            $this->redirect('Operator/login', null,0, '页面跳转中...');
        }    
    }

}