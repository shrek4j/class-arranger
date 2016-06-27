<?php
namespace Home\Model;
use Think\Model;
class RoleModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应

    public function showRoles(){
        $sql = "select * from classoa_role where status=0";
        return $this->query($sql);
    }

}