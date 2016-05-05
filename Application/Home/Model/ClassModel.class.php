<?php
namespace Home\Model;
use Think\Model;
class ClassModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应

    public function saveClass($className,$classtypeId,$remark,$tId){
        $sql = "insert into classoa_class(class_name,class_type_id,remark,inst_id) values('".$className."',".$classtypeId.",'".$remark."',".$tId.")";
        $this->execute($sql);
        $queryIdSql = "SELECT @@IDENTITY as class_id";
        return $this->query($queryIdSql);
    }
    
    public function saveClassDetail($date,$month,$dayOfWeek,$startTime,$endTime,$teacherId,$classroomId,$classId,$tuition,$tId){
        $sql = "insert into classoa_class_detail(date,month,day_of_week,start_time,end_time,teacher_id,classroom_id,class_id,tuition_per_class,inst_id) values('".$date."',".$month.",".$dayOfWeek.",'".$startTime."','".$endTime."',".$teacherId.",".$classroomId.",".$classId.",".$tuition.",".$tId.")";
        $this->execute($sql);
        $queryIdSql = "SELECT @@IDENTITY as class_detail_id";
        return $this->query($queryIdSql);
    }

    public function saveClassDetailAndStudentRela($classDetailId,$classId,$studentId,$tuition,$tId){
        $sql = "insert into classoa_class_detail_student_rela(class_detail_id,class_id,student_id,tuition_per_class,is_absent,inst_id) values(".$classDetailId.",".$classId.",".$studentId.",".$tuitionPerStud.",".$tId.")";
        $this->execute($sql);
    }
    

    ////////////////////////////////////
    ////////////classtype///////////////
    ////////////////////////////////////
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

