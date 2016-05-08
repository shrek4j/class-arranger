<?php
namespace Home\Model;
use Think\Model;
class ClassModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    //////////////////////////
    ///////////class//////////
    //////////////////////////
    public function saveClass($className,$classtypeId,$remark,$tId){
        $sql = "insert into classoa_class(class_name,class_type_id,remark,inst_id) values('".$className."',".$classtypeId.",'".$remark."',".$tId.")";
        $this->execute($sql);
        $queryIdSql = "SELECT @@IDENTITY as class_id";
        return $this->query($queryIdSql);
    }
    
    public function saveClassDetail($date,$year,$month,$dayOfWeek,$startTime,$endTime,$teacherId,$classroomId,$classId,$tuition,$tId){
        $sql = "insert into classoa_class_detail(date,year,month,day_of_week,start_time,end_time,teacher_id,classroom_id,class_id,tuition_per_class,inst_id) values('".$date."','".$year."',".$month.",".$dayOfWeek.",'".$startTime."','".$endTime."',".$teacherId.",".$classroomId.",".$classId.",".$tuition.",".$tId.")";
        $this->execute($sql);
        $queryIdSql = "SELECT @@IDENTITY as class_detail_id";
        return $this->query($queryIdSql);
    }

    public function saveClassDetailAndStudentRela($classDetailId,$classId,$studentId,$tuition,$tId){
        $sql = "insert into classoa_class_detail_student_rela(class_detail_id,class_id,student_id,tuition_per_class,is_absent,inst_id) values(".$classDetailId.",".$classId.",".$studentId.",".$tuitionPerStud.",".$tId.")";
        $this->execute($sql);
    }

    public function delClassDetailAndStudentRela($classDetailId,$studentId,$tId){
        $sql = "update classoa_class_detail_student_rela set status=1 where $inst_id=".$tId." and $class_detail_id=".$classDetailId." and student_id=".$studentId;
        $this->execute($sql);
    }

    public function updateClass($classId,$className,$tId){
        $sql = "update classoa_class set class_name='".$classname."' where class_id=".$classId." and inst_id=".$tId;
        return $this->execute($sql);
    }

    //classoa_class: `status` int(1) NOT NULL DEFAULT '0',
    public function delClass($classId,$tId){
        $sql = "update classoa_class set status=1 where class_id=".$classId." and inst_id=".$tId;
        return $this->execute($sql);
    }
    
    //classoa_class_detail: `status` int(1) NOT NULL DEFAULT '0',
    public function showClassDetails($classId,$tId){
        $sql = "select * from classoa_class_detail where inst_id=".$tId." and class_id=".$classId." and status=0 order by class_detail_id asc";
        return $this->query($sql);
    }

    public function updateClassDetail($date,$year,$month,$dayOfWeek,$startTime,$endTime,$teacherId,$classroomId,$classId,$tuition,$tId){
        $sql = "update classoa_class_detail set date='".$date."',year='".$year."',month=".$month.",day_of_week=".$dayOfWeek.",start_time='".$startTime."',end_time='".$endTime."',teacher_id=".$teacherId.",tuition_per_class=".$tuition." where class_id=".$classId."and classroom_id=".$classroomId." and inst_id=".$tId;
        return $this->execute($sql);
    }

    public function delClassDetail($classId,$classDetailId,$tId){
        $sql = "update classoa_class set status=1 where class_id=".$classId." and class_detail_id=".$classDetailId." and inst_id=".$tId;
        return $this->execute($sql);
    }
    
    public function showClassesByTeacher($tId,$year,$month,$teacherId){
        $sql = "select * from classoa_class_detail where inst_id=".$tId." and year='".$year."' and month='".$month."' and teacher_id=".$teacherId." and status=0 order by date asc,start_time asc";
        return $this->query($sql);
    }

    public function showClassesByClassroom($tId,$year,$month,$classroomId){
        $sql = "select * from classoa_class_detail where inst_id=".$tId." and year='".$year."' and month='".$month."' and classroom_id=".$classroomId." and status=0 order by date asc,start_time asc";
        return $this->query($sql);
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

