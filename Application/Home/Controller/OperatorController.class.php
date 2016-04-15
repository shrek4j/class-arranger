<?php
namespace Home\Controller;
use Think\Controller;
class OperatorController extends Controller {
    // entrance:   http://localhost/index.php/Home/User/login
    public function login(){
        $this->display();
    }
    
    public function logout(){
        
    }
    
    public function doLogin($loginname,$password){
        $operator = new \Home\Model\OperatorModel();
        $result = $operator->queryOperator($loginname,$password);
        if(!empty($result) && count($result) == 1){
            session('operatorId',$result[0]['operator_id']);
            session('instId',$result[0]['inst_id']);
            $this->success('登陆成功', '/index.php/Home/Class/classmain',1);
        }else{
            $this->error('登陆失败');
        }    
    }
}