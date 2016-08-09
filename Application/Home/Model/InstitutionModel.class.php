<?php
namespace Home\Model;
use Think\Model;
class InstitutionModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
    public function saveInstitution($instName){
        $sql = "insert into classoa_institution(name) values('%s')";
        $this->execute($sql,$instName);
        $queryIdSql = "SELECT @@IDENTITY as inst_id";
        return $this->query($queryIdSql);
    }

}

