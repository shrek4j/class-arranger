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
            $this->success('登陆成功', '/index.php/Home/Class/classmain',2);
        }else{
            $this->error('登陆失败');
        }    
    }
}