<?php
namespace Home\Model;
use Think\Model;
class ClassModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
    public function saveClasstype($classtype,$instId){
        $sql = "insert into classoa_classtype(name,inst_id) values('".$classtype."',".$instId.")";
        return $this->execute($sql);
    }
    
    public function total($instId){
    	$sql = "select count(1) total from classoa_classtype where inst_id=".$instId." and status=0";
        return $this->query($sql);
    }

    public function showClassTypes($instId,$start,$pageSize){
        $sql = "select * from classoa_classtype where inst_id=".$instId." and status=0 order by id desc limit ".$start.",".$pageSize;
        return $this->query($sql);
    }

    public function deleteClassType($instId,$classTypeId){
    	$sql = "update classoa_classtype set status=1 where id=".$classTypeId." and inst_id=".$instId;
    	return $this->execute($sql);
    }
}

