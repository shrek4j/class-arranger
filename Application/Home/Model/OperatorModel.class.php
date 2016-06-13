<?php
namespace Home\Model;
use Think\Model;
class OperatorModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应

    public function queryOperator($loginname,$password){
        $sql = "select * from classoa_operator where user_name='%s' and user_pwd='%s'";
        $userList = $this->query($sql,$loginname,md5($password));
        return $userList;
    }
    
}

