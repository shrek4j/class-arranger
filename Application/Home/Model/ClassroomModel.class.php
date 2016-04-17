<?php
namespace Home\Model;
use Think\Model;
class ClassroomModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
    public function saveClassroom($classroom,$instId){
        $sql = "insert into classoa_classroom(name,inst_id) values('".$classroom."',".$instId.")";
        return $this->execute($sql);
    }
    
    public function total($instId){
    	$sql = "select count(1) total from classoa_classroom where inst_id=".$instId." and status=0";
        return $this->query($sql);
    }

    public function showClassrooms($instId,$start,$pageSize){
        $sql = "select * from classoa_classroom where inst_id=".$instId." and status=0 order by classroom_id desc limit ".$start.",".$pageSize;
        return $this->query($sql);
    }

    public function deleteClassroom($instId,$classroomId){
    	$sql = "update classoa_classroom set status=1 where classroom_id=".$classroomId." and inst_id=".$instId;
    	return $this->execute($sql);
    }
}

