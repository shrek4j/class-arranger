<?php
namespace Home\Controller;
use Think\Controller;
class OperatorController extends Controller {
    // entrance:   http://localhost/index.php/Home/Operator/login
    public function login(){
        $this->display();
    }
    
    public function logout(){
        session('operatorId', null);
        session('instId', null);
        $this->success('退出成功', '/index.php/Home/Operator/login',2);
    }
    
    public function doLogin($loginname,$password){
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
        if (false !== strpos($ip, ','))  
            $ip = reset(explode(',', $ip));  

            //add login log
            $operator->addLoginLog($result[0]['operator_id'],date('Y-m-d H:i:s',time()),$ip);

            $this->success('登陆成功', '/index.php/Home/Class/showClassList?nav=44&pnav=40',2);
        }else{
            $this->error('登陆失败');
        }    
    }

}