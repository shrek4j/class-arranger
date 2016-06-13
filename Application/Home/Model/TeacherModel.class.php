<?php
namespace Home\Model;
use Think\Model;
class TeacherModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
    public function saveTeacher($teacher,$instId){
        $sql = "insert into classoa_teacher(name,inst_id) values('%s',%d)";
        return $this->execute($sql,$teacher,$instId);
    }
    
    public function total($instId){
    	$sql = "select count(1) total from classoa_teacher where inst_id=%d and status=0";
        return $this->query($sql,$instId);
    }

    public function showTeachers($instId,$start,$pageSize){
        $sql = "select * from classoa_teacher where inst_id=%d and status=0 order by teacher_id desc limit %d,%d";
        return $this->query($sql,$instId,$start,$pageSize);
    }

    public function deleteTeacher($instId,$teacherId){
    	$sql = "update classoa_teacher set status=1 where teacher_id=%d and inst_id=%d";
    	return $this->execute($sql,$teacherId,$instId);
    }
}

