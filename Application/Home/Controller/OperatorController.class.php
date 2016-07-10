<?php
namespace Home\Controller;
use Think\Controller;
define("TO_HACKERS","stop fucking around");
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
        session('operatorName',null);
        session('isSuperAdmin',null);
        session('role',null);
        $this->redirect('Operator/login', null,0, '页面跳转中...');
    }
    
    public function doLogin($loginname,$password){
        if(session('can_doLogin') != true){
            echo TO_HACKERS;
            return;
        }
        session('can_doLogin',false);
        $operator = new \Home\Model\OperatorModel();
        $result = $operator->queryOperator($loginname,$password);
        if(!empty($result) && count($result) == 1){
            session('operatorId',$result[0]['operator_id']);
            session('instId',$result[0]['inst_id']);
            session('operatorName',$result[0]['user_name']);
            session('isSuperAdmin',$result[0]['is_super_admin']);
            session('teacherId',$result[0]['teacher_id']);
            if($result[0]['is_super_admin'] == 1){
                session('role',"超级管理员");
            }else{
                session('role',"管理员");
            }

            $roleList = $operator->findRolesByOperator($result[0]['inst_id'],$result[0]['operator_id']);
            for($i=0;$i<count($roleList);$i++){
                if($roleList[$i]['code']=='ROLE_TEACHER'){
                    session('ROLE_TEACHER',1);
                }
                //TODO 添加角色权限
            }

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
            $this->redirect('Operator/showDashboard', null,0, '页面跳转中...');
        }else{
            session("loginErr",1);
            $this->redirect('Operator/login', null,0, '页面跳转中...');
        }    
    }

    public function showDashboard(){
        $this->display();
    }
    
}