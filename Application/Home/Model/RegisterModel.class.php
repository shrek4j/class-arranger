<?php
namespace Home\Model;
use Think\Model;
class RegisterModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
    public function saveRegister($instName,$applicant,$classType,$studentAges,$email,$wechat,$remark,$instId,$isOnline,$province,$city,$district){
        $sql = "insert into classoa_register(inst_name,applicant,class_type,student_ages,email,wechat,remark,inst_id,is_online,province,city,district) values('%s','%s','%s','%s','%s','%s','%s', %d, %d, %d, %d, %d)";
        $this->execute($sql,$instName,$applicant,$classType,$studentAges,$email,$wechat,$remark,$instId,$isOnline,$province,$city,$district);
    }

}

