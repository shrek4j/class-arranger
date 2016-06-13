<?php
namespace Home\Model;
use Think\Model;
class StudentModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
    public function saveStudent($studentName,$studPinyin,$gender,$grade,$school,$parentName,$mobile,$tuition,$instId){
        $sql = "insert into classoa_student(student_name,pinyin,gender,grade,school,parent_name,phone,balance,inst_id) values('%s','%s',%d,%d,'%s','%s','%s',%d,%d)";
        return $this->execute($sql,$studentName,$studPinyin,$gender,$grade,$school,$parentName,$mobile,$tuition,$instId);
    }

    public function changeStudentStatus($studentId,$instId,$status){
        $sql = "update classoa_student set status=%d where inst_id=%d and student_id=%d";
        return $this->execute($sql,$status,$instId,$studentId);
    }
    
    public function total($instId){
    	$sql = "select count(1) total from classoa_student where inst_id=%d and status=0";
        return $this->query($sql,$instId);
    }

    public function showStudents($instId,$start,$pageSize){
        $sql = "select * from classoa_student where inst_id=%d and status=0 order by student_id desc limit %d,%d";
        return $this->query($sql,$instId,$start,$pageSize);
    }

    public function showStudentDetail($instId,$studentId){
        $sql = "select * from classoa_student where student_id=%d and inst_id=%d and status=0";
        return $this->query($sql,$studentId,$instId);
    }

    public function deleteStudent($instId,$studentId){
    	$sql = "update classoa_student set status=1 where student_id=%d and inst_id=%d";
    	return $this->execute($sql,$studentId,$instId);
    }
}

