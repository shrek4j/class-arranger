<?php
namespace Home\Model;
use Think\Model;
class StudentModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    
    public function saveStudent($studentName,$studPinyin,$gender,$grade,$school,$remark,$mobile,$tuition,$instId,$interest){
        $sql = "insert into classoa_student(student_name,pinyin,gender,grade,school,remark,phone,balance,inst_id,interested_class) values('%s','%s',%d,%d,'%s','%s','%s',%d,%d,%d)";
        $this->execute($sql,$studentName,$studPinyin,$gender,$grade,$school,$remark,$mobile,$tuition,$instId,$interest);
        $queryIdSql = "SELECT @@IDENTITY as student_id";
        return $this->query($queryIdSql);
    }

    public function updateStudent($studentName,$studPinyin,$gender,$grade,$school,$remark,$mobile,$balance,$studentId,$instId){
        $sql = "update classoa_student set student_name='%s',pinyin='%s',gender=%d,grade=%d,school='%s',remark='%s',phone='%s',balance=%d where student_id=%d and inst_id=%d";
        return $this->execute($sql,$studentName,$studPinyin,$gender,$grade,$school,$remark,$mobile,$balance,$studentId,$instId);
    }

    public function changeStudentStatus($studentId,$instId,$status){
        $sql = "update classoa_student set status=%d where inst_id=%d and student_id=%d";
        return $this->execute($sql,$status,$instId,$studentId);
    }
    
    public function total($instId){
    	$sql = "select count(1) total from classoa_student where inst_id=%d and status<>1";
        return $this->query($sql,$instId);
    }

    public function showStudents($instId,$start,$pageSize){
        $sql = "select * from classoa_student where inst_id=%d and status<>1 order by student_id desc limit %d,%d";
        return $this->query($sql,$instId,$start,$pageSize);
    }

    public function showStudentDetail($instId,$studentId){
        $sql = "select * from classoa_student where student_id=%d and inst_id=%d and status<>1";
        return $this->query($sql,$studentId,$instId);
    }

    public function deleteStudent($instId,$studentId){
    	$sql = "update classoa_student set status=1 where student_id=%d and inst_id=%d";
    	return $this->execute($sql,$studentId,$instId);
    }

    public function showStudentBalance($instId,$studentId){
        $sql = "select balance from classoa_student where student_id=%d and inst_id=%d and status<>1";
        return $this->query($sql,$studentId,$instId);
    }

    public function addStudentBalance($newTuition,$studentId,$instId){
        $sql = "update classoa_student set balance=balance+%d where student_id=%d and inst_id=%d";
        return $this->execute($sql,$newTuition,$studentId,$instId);
    }

    public function updateStudentBalance($deduction,$studentId,$instId){
        $sql = "update classoa_student set balance=balance-%d where student_id=(SELECT student_id FROM classoa_class_detail_student_rela WHERE id =  %d) and inst_id=%d";
        return $this->execute($sql,$deduction,$studentId,$instId);
    }
}

