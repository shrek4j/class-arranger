<?php
namespace Home\Model;
use Think\Model;
class StudentModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
    public function saveStudent($studentName,$gender,$grade,$school,$parentName,$mobile,$tuition,$instId){
        $sql = "insert into classoa_student(student_name,gender,grade,school,parent_name,phone,balance,inst_id) values('".$studentName."',".$gender.",".$grade.",'".$school."','".$parentName."','".$mobile."',".$tuition.",".$instId.")";
        return $this->execute($sql);
    }
    
    public function total($instId){
    	$sql = "select count(1) total from classoa_student where inst_id=".$instId." and status=0";
        return $this->query($sql);
    }

    public function showStudents($instId,$start,$pageSize){
        $sql = "select * from classoa_student where inst_id=".$instId." and status=0 order by student_id desc limit ".$start.",".$pageSize;
        return $this->query($sql);
    }

    public function deleteStudent($instId,$studentId){
    	$sql = "update classoa_student set status=1 where student_id=".$studentId." and inst_id=".$instId;
    	return $this->execute($sql);
    }
}

