<?php
namespace Home\Model;
use Think\Model;
class ClassModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    //////////////////////////
    ///////////class//////////
    //////////////////////////
    public function saveClass($className,$classtypeId,$tuition,$wage,$startDate,$endDate,$teacherId,$classroomId,$remark,$timecn,$tId){
        $sql = "insert into classoa_class(class_name,class_type_id,tuition_per_class,wage,start_date,end_date,teacher_id,classroom_id,remark,timecn,inst_id) values('".$className."',".$classtypeId.",".$tuition.",".$wage.",'".$startDate."','".$endDate."',".$teacherId.",".$classroomId.",'".$remark."','".$timecn."',".$tId.")";
        $this->execute($sql);
        $queryIdSql = "SELECT @@IDENTITY as class_id";
        return $this->query($queryIdSql);
    }

    public function showClassById($classId,$tId){
        $sql = "select c.class_id class_id,c.class_name class_name,cc.name classtype_name from classoa_class c left join classoa_classtype cc on c.class_type_id=cc.id where c.inst_id=".$tId." and c.class_id=".$classId;
        return $this->query($sql);
    }

    public function getClassById($classId,$tId){
        $sql = "select * from classoa_class where inst_id=".$tId." and class_id=".$classId;
        return $this->query($sql);
    }
    
    public function saveClassDetail($date,$year,$month,$dayOfWeek,$startTime,$startTimeInt,$endTime,$teacherId,$classroomId,$classId,$tId){
        $sql = "insert into classoa_class_detail(date,year,month,day_of_week,start_time,start_time_int,end_time,teacher_id,classroom_id,class_id,inst_id) values('".$date."','".$year."',".$month.",".$dayOfWeek.",'".$startTime."',".$startTimeInt.",'".$endTime."',".$teacherId.",".$classroomId.",".$classId.",".$tId.")";
        $this->execute($sql);
        $queryIdSql = "SELECT @@IDENTITY as class_detail_id";
        return $this->query($queryIdSql);
    }

    public function saveClassDetailAndStudentRela($classDetailId,$classId,$studentId,$tuition,$tId){
        $sql = "insert into classoa_class_detail_student_rela(class_detail_id,class_id,student_id,tuition_per_class,inst_id) values(".$classDetailId.",".$classId.",".$studentId.",".$tuition.",".$tId.")";
        $this->execute($sql);
    }

    public function selectStudentFromClass($tId,$classId,$studentId){
        $sql = "select count(1) count from classoa_class_student_rela where inst_id=".$tId." and class_id=".$classId." and student_id=".$studentId;
        return $this->query($sql);
    }

    public function saveClassAndStudentRela($classId,$studentId,$tuition,$status,$tId){
        $sql = "insert into classoa_class_student_rela(class_id,student_id,tuition_per_class,status,inst_id) values(".$classId.",".$studentId.",".$tuition.",".$status.",".$tId.")";
        $this->execute($sql);
    }

    public function delClassDetailAndStudentRela($classDetailId,$studentId,$tId){
        $sql = "update classoa_class_detail_student_rela set status=1 where inst_id=".$tId." and class_detail_id=".$classDetailId." and student_id=".$studentId;
        $this->execute($sql);
    }

    public function deleteClassDetailAndStudentRelas($classId,$tId){
        $sql = "update classoa_class_detail_student_rela set status=1 where inst_id=".$tId." and class_id=".$classId;
        $this->execute($sql);
    }

    public function updateClassDetailStudentRela($relaId,$isAbsent,$tId){
        $sql = "update classoa_class_detail_student_rela set is_absent='".$isAbsent."' where id=".$relaId." and inst_id=".$tId;
        return $this->execute($sql);
    }

    public function showStudentsFromClassDetail($classDetailId,$tId){
        $sql = "select r.*, s.student_name student_name,s.phone mobile from classoa_class_detail_student_rela r left join classoa_student s on r.student_id=s.student_id where r.inst_id=".$tId." and r.class_detail_id=".$classDetailId." and r.status=0";
        return $this->query($sql);
    }

    public function showStudentsFromClass($classId,$tId){
        $sql = "select r.*, s.student_name student_name from classoa_class_student_rela r left join classoa_student s on r.student_id=s.student_id where r.inst_id=".$tId." and r.class_id=".$classId." and r.status=0";
        return $this->query($sql);
    }

    public function showAllStudentsFromClass($classId,$tId){
        $sql = "select r.*, s.student_name student_name from classoa_class_student_rela r left join classoa_student s on r.student_id=s.student_id where r.inst_id=".$tId." and r.class_id=".$classId;
        return $this->query($sql);
    }

    public function updateStudentTuitionForClass($tId,$classId,$studentId,$tuition){
        $sql = "update classoa_class_student_rela set tuition_per_class='".$tuition."' where class_id=".$classId." and inst_id=".$tId." and student_id=".$studentId;
        return $this->execute($sql);
    }

    public function updateStudentStatusFromClass($tId,$classId,$studentId,$status){
        $sql = "update classoa_class_student_rela set status='".$status."' where class_id=".$classId." and inst_id=".$tId." and student_id=".$studentId;
        return $this->execute($sql);
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
        $sql = "select count(1) total from classoa_class where inst_id=".$instId." and status=0";
        return $this->query($sql);
    }

    public function showClassList($instId,$start,$pageSize){
        $sql = "select cc.*,ct.name classtype_name,t.name teacher_name,cr.name classroom_name from classoa_class cc left join classoa_classtype ct on cc.class_type_id=ct.id left join classoa_teacher t on cc.teacher_id=t.teacher_id left join classoa_classroom cr on cc.classroom_id=cr.classroom_id where cc.inst_id=".$instId." and cc.status=0 order by cc.class_id asc limit ".$start.",".$pageSize;
        return $this->query($sql);
    }
    
    public function showClassDetails($classId,$tId){
        $sql = "select cd.*,ct.name teacher_name,cc.name classroom_name from classoa_class_detail cd left join classoa_teacher ct on cd.teacher_id=ct.teacher_id left join classoa_classroom cc on cd.classroom_id=cc.classroom_id where cd.inst_id=".$tId." and cd.class_id=".$classId." and cd.status=0 order by cd.class_detail_id asc";
        return $this->query($sql);
    }

    public function showClassDetailsById($classId,$tId){
        $sql = "select * from classoa_class_detail where inst_id=".$tId." and class_id=".$classId." and status=0 order by date asc,start_time_int asc";
        return $this->query($sql);
    }

    public function updateClassDetail($date,$year,$month,$dayOfWeek,$startTime,$startTimeInt,$endTime,$teacherId,$classroomId,$classDetailId,$tId){
        $sql = "update classoa_class_detail set date='".$date."',year='".$year."',month=".$month.",day_of_week=".$dayOfWeek.",start_time='".$startTime."',start_time_int=".$startTimeInt.",end_time='".$endTime."',teacher_id=".$teacherId.",classroom_id=".$classroomId." where class_detail_id=".$classDetailId." and inst_id=".$tId;
        return $this->execute($sql);
    }

    public function updateClassDetailIsAbsentCheck($classDetailId,$tId,$isAbsentCheck){
        $sql = "update classoa_class_detail set is_absent_check=".$isAbsentCheck." where class_detail_id=".$classDetailId." and inst_id=".$tId;
        return $this->execute($sql);
    }

    public function deleteClassDetail($classId,$classDetailId,$tId){
        $sql = "update classoa_class_detail set status=1 where class_id=".$classId." and class_detail_id=".$classDetailId." and inst_id=".$tId;
        return $this->execute($sql);
    }

    public function deleteClassDetails($classId,$tId){
        $sql = "update classoa_class_detail set status=1 where class_id=".$classId." and inst_id=".$tId;
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

    public function updateStudentStatusFromClassDetail($tId,$classId,$classDetailId,$studentId,$status){
        $sql = "update classoa_class_detail_student_rela set status='".$status."' where class_detail_id=".$classDetailId." and class_id=".$classId." and inst_id=".$tId." and student_id=".$studentId;
        return $this->execute($sql);
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

