<?php
namespace Home\Model;
use Think\Model;
class OperatorModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应

    public function queryOperator($loginname,$password){
        $sql = "select * from classoa_operator where user_name='%s' and user_pwd='%s' and status=0 and disabled=0";
        $userList = $this->query($sql,$loginname,md5($password));
        return $userList;
    }

    public function findRolesByOperator($instId,$operatorId){
        $sql = "select cr.code,cr.name from classoa_role cr join classoa_operator_role_rela corr on cr.role_id=corr.role_id join classoa_operator co on corr.operator_id=co.operator_id where co.operator_id=%d and co.inst_id=%d";
        $roleList = $this->query($sql,$operatorId,$instId);
        return $roleList;
    }

    public function addLoginLog($operatorId,$loginTime,$ip,$location){
    	$sql = "insert into classoa_operator_login_log (operator_id,login_time,ip,location) values(%d,'%s','%s','%s')";
    	$this->execute($sql,$operatorId,$loginTime,$ip,$location);
    }
    
    public function addOperator($instId,$userName,$userPwd,$isSuperAdmin,$realName,$teacher){
        $sql = "insert into classoa_operator(inst_id,user_name,user_pwd,is_super_admin,real_name,teacher_id) values(%d,'%s','%s',%d,'%s',%d)";
        $this->execute($sql,$instId,$userName,md5($userPwd),$isSuperAdmin,$realName,$teacher);
        $queryIdSql = "SELECT @@IDENTITY as operator_id";
        return $this->query($queryIdSql);
    }

    public function addOperatorAndRoleRela($operatorId,$roleId){
        $sql = "insert into classoa_operator_role_rela(operator_id,role_id) values(%d,%d)";
        $this->execute($sql,$operatorId,$roleId);
    }

    public function deleteOperator($instId,$operatorId){
        $sql = "update classoa_operator set status=1 where operator_id=%d and inst_id=%d";
        return $this->execute($sql,$operatorId,$instId);
    }

    public function deleteOperatorByTeacherId($instId,$teacherId){
        $sql = "update classoa_operator set status=1 where teacher_id=%d and inst_id=%d";
        return $this->execute($sql,$teacherId,$instId);
    }


    public function toggleDisabled($instId,$operatorId,$disabled){
        $sql = "update classoa_operator set disabled=%d where operator_id=%d and inst_id=%d";
        return $this->execute($sql,$disabled,$operatorId,$instId);
    }

    public function showOperators($instId,$start,$pageSize){
        $sql = "select * from classoa_operator where inst_id=%d and status=0 order by disabled asc,operator_id desc limit %d,%d";
        return $this->query($sql,$instId,$start,$pageSize);
    }

    public function total($instId){
        $sql = "select count(1) total from classoa_operator where inst_id=%d and status=0";
        return $this->query($sql,$instId);
    }

    public function showSuperAdmin($instId){
        $sql = "select teacher_id from classoa_operator where inst_id=%d and status=0 and is_super_admin=1";
        return $this->query($sql,$instId);
    }

    public function updateSuperAdmin($instId,$teacher){
        $sql = "update classoa_operator set teacher_id=%d where is_super_admin=1 and inst_id=%d";
        return $this->execute($sql,$teacher,$instId);
    }

    public function saveOperatorPwd($instId,$operatorId,$userPwd){
        $sql = "update classoa_operator set user_pwd='%s' where operator_id=%d and inst_id=%d";
        return $this->execute($sql,md5($userPwd),$operatorId,$instId);
    }

    public function checkLoginname($loginname){
        $sql = "select * from classoa_operator where user_name='%s' and status=0 and disabled=0";
        $userList = $this->query($sql,$loginname);
        return $userList;
    }
    
}

