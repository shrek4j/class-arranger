<?php
namespace Home\Model;
use Think\Model;
class ClassroomModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
    public function saveClassroom($classroom,$rent,$instId){
        $sql = "insert into classoa_classroom(name,rent_per_month,inst_id) values('%s',%d,%d)";
        return $this->execute($sql,$classroom,$rent,$instId);
    }
    
    public function total($instId){
    	$sql = "select count(1) total from classoa_classroom where inst_id=%d and status=0";
        return $this->query($sql,$instId);
    }

    public function showClassrooms($instId,$start,$pageSize){
        $sql = "select * from classoa_classroom where inst_id=%d and status=0 order by classroom_id desc limit %d,%d";
        return $this->query($sql,$instId,$start,$pageSize);
    }

    public function deleteClassroom($instId,$classroomId){
    	$sql = "update classoa_classroom set status=1 where classroom_id=%d and inst_id=%d";
    	return $this->execute($sql,$classroomId,$instId);
    }
}

