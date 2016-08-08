<?php
namespace Home\Controller;
use Think\Controller;
define("TO_HACKERS","请登录");
class OperatorController extends Controller {
    // entrance:   http://localhost/index.php/Home/Operator/login
    public function login(){
        if(session("loginErr")==1){
            $this->assign("login_msg","用户名或密码错误！");
        }
        $this->display();
    }
    
    public function logout(){
//        session('operatorId', null);
//        session('instId', null);
//        session('operatorName',null);
//        session('isSuperAdmin',null);
//        session('role',null);
        session('[destroy]');
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
            
            //add login log
            try{
                $ip = get_client_ip();
                $loc = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
                $locationArr = $loc->getlocation($ip);
                $location = $locationArr['country'].$locationArr['area'];
                $operator->addLoginLog($result[0]['operator_id'],date('Y-m-d H:i:s',time()),$ip,$location);
            }catch(Exception $e){
                //do nothing
            }
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

    public function profile(){
        $this->display();
    }
    
    public function editProfile($userPwd0,$userPwd1){
        $instId = session('instId');
        $operatorId = session('operatorId');
        $operatorName = session('operatorName');
        try{
            $operator = new \Home\Model\OperatorModel();
            $result = $operator->queryOperator($operatorName,$userPwd0);
            if(!empty($result) && count($result) == 1){
                $operatorId = $operator->saveOperatorPwd($instId,$operatorId,$userPwd1);
                $data = "true";
            }else{
                $data = "originPwd wrong";
            }
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showRegisterInstruction(){
        $this->display();
    }

    //移动端注册专用
    public function showRegister(){
        $this->display();
    }

    public function doRegister(){
        
    }

    public function checkLoginname($loginname){
        $operator = new \Home\Model\OperatorModel();
        $result = $operator->checkLoginname($loginname);
        if(!empty($result) && count($result) >= 1){
            $data = "false";
        }else{
            $data = "true";
        }
        $this->ajaxReturn($data);
    }

}

//backup:获取IP
/*
$unknown = 'unknown';  
if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] 
    && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {  
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
} elseif ( isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] 
    && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {  
    $ip = $_SERVER['REMOTE_ADDR'];  
}  
if (false !== strpos($ip, ',')){
    $ip = reset(explode(',', $ip)); 
}
*/