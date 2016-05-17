<?php
namespace Home\Model;
use Think\Model;
class ClassModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    //////////////////////////
    ///////////class//////////
    //////////////////////////
    public function saveClass($className,$classtypeId,$startDate,$endDate,$teacherId,$classroomId,$remark,$tId){
        $sql = "insert into classoa_class(class_name,class_type_id,start_date,end_date,teacher_id,classroom_id,remark,inst_id) values('".$className."',".$classtypeId.",'".$startDate."','".$endDate."',".$teacherId.",".$classroomId.",'".$remark."',".$tId.")";
        $this->execute($sql);
        $queryIdSql = "SELECT @@IDENTITY as class_id";
        return $this->query($queryIdSql);
    }
    
    public function saveClassDetail($date,$year,$month,$dayOfWeek,$startTime,$startTimeInt,$endTime,$teacherId,$classroomId,$classId,$tuition,$tId){
        $sql = "insert into classoa_class_detail(date,year,month,day_of_week,start_time,start_time_int,end_time,teacher_id,classroom_id,class_id,tuition_per_class,inst_id) values('".$date."','".$year."',".$month.",".$dayOfWeek.",'".$startTime."',".$startTimeInt.",'".$endTime."',".$teacherId.",".$classroomId.",".$classId.",".$tuition.",".$tId.")";
        $this->execute($sql);
        $queryIdSql = "SELECT @@IDENTITY as class_detail_id";
        return $this->query($queryIdSql);
    }

    public function saveClassDetailAndStudentRela($classDetailId,$classId,$studentId,$tuition,$tId){
        $sql = "insert into classoa_class_detail_student_rela(class_detail_id,class_id,student_id,tuition_per_class,inst_id) values(".$classDetailId.",".$classId.",".$studentId.",".$tuition.",".$tId.")";
        $this->execute($sql);
    }

    public function delClassDetailAndStudentRela($classDetailId,$studentId,$tId){
        $sql = "update classoa_class_detail_student_rela set status=1 where $inst_id=".$tId." and $class_detail_id=".$classDetailId." and student_id=".$studentId;
        $this->execute($sql);
    }

    public function showStudentsFromClassDetail($classDetailId,$tId){
        $sql = "select * from classoa_class_detail_student_rela r left join classoa_student s on r.student_id=s.student_id where $inst_id=".$tId." and $class_detail_id=".$classDetailId;
        return $this->query($sql);
    }

    public function updateClass($classId,$className,$tId){
        $sql = "update classoa_class set class_name='".$classname."' where class_id=".$classId." and inst_id=".$tId;
        return $this->execute($sql);
    }

    //classoa_class: `status` int(1) NOT NULL DEFAULT '0',
    public function deleteClass($classId,$tId){
        $sql = "update classoa_class set status=1 where class_id=".$classId." and inst_id=".$tId;
        return $this->execute($sql);
    }

    public function totalClasses($instId){
        $sql = "select count(1) total from classoa_classtype where inst_id=".$instId." and status=0";
        return $this->query($sql);
    }

    public function showClassList($instId,$start,$pageSize){
        $sql = "select cc.*,ct.name classtype_name,t.name teacher_name,cr.name classroom_name from classoa_class cc left join classoa_classtype ct on cc.class_type_id=ct.id left join classoa_teacher t on cc.teacher_id=t.teacher_id left join classoa_classroom cr on cc.classroom_id=cr.classroom_id where cc.inst_id=".$instId." and cc.status=0 order by cc.class_id desc limit ".$start.",".$pageSize;
        return $this->query($sql);
    }
    
    //classoa_class_detail: `status` int(1) NOT NULL DEFAULT '0',
    public function showClassDetails($classId,$tId){
        $sql = "select cd.*,ct.name teacher_name,cc.name classroom_name from classoa_class_detail cd left join classoa_teacher ct on cd.teacher_id=ct.teacher_id left join classoa_classroom cc on cd.classroom_id=cc.classroom_id where cd.inst_id=".$tId." and cd.class_id=".$classId." and cd.status=0 order by cd.class_detail_id asc";
        return $this->query($sql);
    }

    public function updateClassDetail($date,$year,$month,$dayOfWeek,$startTime,$endTime,$teacherId,$classroomId,$classId,$tuition,$tId){
        $sql = "update classoa_class_detail set date='".$date."',year='".$year."',month=".$month.",day_of_week=".$dayOfWeek.",start_time='".$startTime."',end_time='".$endTime."',teacher_id=".$teacherId.",tuition_per_class=".$tuition." where class_id=".$classId."and classroom_id=".$classroomId." and inst_id=".$tId;
        return $this->execute($sql);
    }

    public function deleteClassDetail($classId,$classDetailId,$tId){
        $sql = "update classoa_class set status=1 where class_id=".$classId." and class_detail_id=".$classDetailId." and inst_id=".$tId;
        return $this->execute($sql);
    }
    
    public function showClassesByTeacher($tId,$year,$month,$teacherId){
        $sql = "select d.*,c.class_name class_name,r.name classroom_name from classoa_class_detail d left join classoa_class c on d.class_id=c.class_id left join classoa_classroom r on d.classroom_id=r.classroom_id where d.inst_id=".$tId." and d.year='".$year."' and d.month='".$month."' and d.teacher_id=".$teacherId." and d.status=0 order by d.date asc,d.start_time_int asc";
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
    
    public function totalClasstypes($instId){
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

