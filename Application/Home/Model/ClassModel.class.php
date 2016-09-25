<?php
namespace Home\Model;
use Think\Model;
class ClassModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields =false;//模型和数据表无需一一对应
    //////////////////////////
    ///////////class//////////
    //////////////////////////
    public function saveClass($className,$classtypeId,$tuition,$wage,$startDate,$endDate,$teacherId,$classroomId,$remark,$deductFlag,$timecn,$tId){
        $sql = "insert into classoa_class(class_name,class_type_id,tuition_per_class,wage,start_date,end_date,teacher_id,classroom_id,remark,timecn,inst_id,deduct_flag) values('%s',%d,%d,%d,'%s','%s',%d,%d,'%s','%s',%d,%d)";
        $this->execute($sql,$className,$classtypeId,$tuition,$wage,$startDate,$endDate,$teacherId,$classroomId,$remark,$timecn,$tId,$deductFlag);
        $queryIdSql = "SELECT @@IDENTITY as class_id";
        return $this->query($queryIdSql);
    }

    public function showClassById($classId,$tId){
        $sql = "select c.class_id class_id,c.class_name class_name,cc.name classtype_name from classoa_class c left join classoa_classtype cc on c.class_type_id=cc.id where c.class_id=%d and c.inst_id=%d";
        return $this->query($sql,$classId,$tId);
    }

    public function getClassById($classId,$tId){
        $sql = "select * from classoa_class where class_id=%d and inst_id=%d";
        return $this->query($sql,$classId,$tId);
    }

    public function getTuitionFromClass($classId,$tId){
        $sql = "select tuition_per_class from classoa_class where class_id=%d and inst_id=%d";
        return $this->query($sql,$classId,$tId);
    }

    public function countUnfinishedClasses($today,$startTimeInt,$classId,$tId){
        $sql = "SELECT COUNT(1) count FROM classoa_class_detail WHERE class_id=%d AND inst_id=%d AND ((`date`='%s' AND start_time_int>%d) OR (`date`>'%s'))";
        return $this->query($sql,$classId,$tId,$today,$startTimeInt,$today);
    }
    
    public function saveClassDetail($date,$year,$month,$dayOfWeek,$startTime,$startTimeInt,$endTime,$teacherId,$classroomId,$classId,$tId){
        $sql = "insert into classoa_class_detail(date,year,month,day_of_week,start_time,start_time_int,end_time,teacher_id,classroom_id,class_id,inst_id) values('%s','%s',%d,%d,'%s',%d,'%s',%d,%d,%d,%d)";
        $this->execute($sql,$date,$year,$month,$dayOfWeek,$startTime,$startTimeInt,$endTime,$teacherId,$classroomId,$classId,$tId);
        $queryIdSql = "SELECT @@IDENTITY as class_detail_id";
        return $this->query($queryIdSql);
    }

    public function saveClassDetailAndStudentRela($classDetailId,$classId,$studentId,$tuition,$tId){
        $sql = "insert into classoa_class_detail_student_rela(class_detail_id,class_id,student_id,tuition_per_class,inst_id) values(%d,%d,%d,%d,%d)";
        $this->execute($sql,$classDetailId,$classId,$studentId,$tuition,$tId);
    }

    public function selectStudentFromClass($tId,$classId,$studentId){
        $sql = "select count(1) count from classoa_class_student_rela where class_id=%d and student_id=%d and inst_id=%d";
        return $this->query($sql,$classId,$studentId,$tId);
    }

    public function selectStudentInfoFromClass($tId,$classId,$studentId){
        $sql = "select * from classoa_class_student_rela where class_id=%d and student_id=%d and inst_id=%d";
        return $this->query($sql,$classId,$studentId,$tId);
    }

    public function saveClassAndStudentRela($classId,$studentId,$tuition,$status,$tId,$receivableTuition,$receviedTuition){
        $sql = "insert into classoa_class_student_rela(class_id,student_id,tuition_per_class,status,inst_id,receivable_tuition,received_tuition) values(%d,%d,%d,%d,%d,%d,%d)";
        $this->execute($sql,$classId,$studentId,$tuition,$status,$tId,$receivableTuition,$receviedTuition);
    }

    public function delClassDetailAndStudentRela($classDetailId,$studentId,$tId){
        $sql = "update classoa_class_detail_student_rela set status=1 where class_detail_id=%d and student_id=%d and inst_id=%d";
        $this->execute($sql,$classDetailId,$studentId,$tId);
    }

    public function deleteClassDetailAndStudentRelas($classId,$tId){
        $sql = "update classoa_class_detail_student_rela set status=1 where class_id=%d and inst_id=%d";
        $this->execute($sql,$classId,$tId);
    }

    public function updateClassDetailStudentRela($relaId,$isAbsent,$tId){
        $sql = "update classoa_class_detail_student_rela set is_absent=%d where id=%d and inst_id=%d";
        return $this->execute($sql,$isAbsent,$relaId,$tId);
    }

    public function showStudentsFromClassDetail($classDetailId,$tId){
        $sql = "select r.*, s.student_name student_name,s.phone mobile from classoa_class_detail_student_rela r left join classoa_student s on r.student_id=s.student_id where r.class_detail_id=%d and r.inst_id=%d and r.status=0";
        return $this->query($sql,$classDetailId,$tId);
    }

    public function getClassDeductFlag($classId,$tId){
        $sql = "select deduct_flag from classoa_class where class_id=%d and inst_id=%d";
        return $this->query($sql,$classId,$tId); 
    }

    public function showStudentsFromClass($classId,$tId){
        $sql = "select r.*, s.student_name student_name from classoa_class_student_rela r left join classoa_student s on r.student_id=s.student_id where r.class_id=%d and r.inst_id=%d and r.status=0";
        return $this->query($sql,$classId,$tId);
    }

    public function showAllStudentsFromClass($classId,$tId){
        $sql = "select r.*, s.student_name student_name from classoa_class_student_rela r left join classoa_student s on r.student_id=s.student_id where r.class_id=%d and r.inst_id=%d";
        return $this->query($sql,$classId,$tId);
    }

    public function showClassesByStudent($studentId,$tId){
        $sql = "select r.*, s.student_name student_name,c.class_name,class_name,c.start_date start_date,c.end_date end_date from classoa_class_student_rela r left join classoa_student s on r.student_id=s.student_id left join classoa_class c on r.class_id=c.class_id where r.student_id=%d and r.inst_id=%d and r.status=0";
        return $this->query($sql,$studentId,$tId);
    }

    public function showAllStudentsFromClassDetail($classDetailId,$tId){
        $sql = "select id,tuition_per_class from classoa_class_detail_student_rela where class_detail_id=%d and inst_id=%d and status=0";
        return $this->query($sql,$classDetailId,$tId);
    }

    public function updateStudentTuitionForClass($tId,$classId,$studentId,$tuition){
        $sql = "update classoa_class_student_rela set tuition_per_class=%d where class_id=%d and student_id=%d and inst_id=%d";
        return $this->execute($sql,$tuition,$classId,$studentId,$tId);
    }

    public function updateStudentTuitionById($chargeTuition,$id,$instId){
        $sql = "update classoa_class_student_rela set received_tuition=%d+received_tuition where id=%d and inst_id=%d";
        return $this->execute($sql,$chargeTuition,$id,$instId);
    }

     public function updateStudentTuitionForClassDetailAndStudentRela($tId,$classId,$studentId,$tuition){
        $sql = "update classoa_class_detail_student_rela set tuition_per_class=%d where class_id=%d and student_id=%d and inst_id=%d and status=0";
        return $this->execute($sql,$tuition,$classId,$studentId,$tId);
    }

    public function updateStudentStatusFromClass($tId,$classId,$studentId,$status,$receivableTuition){
        $sql = "update classoa_class_student_rela set status=%d,receivable_tuition=receivable_tuition+%d where class_id=%d and student_id=%d and inst_id=%d";
        return $this->execute($sql,$status,$receivableTuition,$classId,$studentId,$tId);
    }

    public function updateClass($classId,$className,$tId){
        $sql = "update classoa_class set class_name='%s' where class_id=%d and inst_id=%d";
        return $this->execute($sql,$className,$classId,$tId);
    }

    public function deleteClass($classId,$tId){
        $sql = "update classoa_class set status=1 where class_id=%d and inst_id=%d";
        return $this->execute($sql,$classId,$tId);
    }

    public function totalClasses($instId){
        $sql = "select count(1) total from classoa_class where inst_id=%d and status=0";
        return $this->query($sql,$instId);
    }

    public function showClassList($instId,$start,$pageSize){
        $sql = "select cc.*,ct.name classtype_name,t.name teacher_name,cr.name classroom_name from classoa_class cc left join classoa_classtype ct on cc.class_type_id=ct.id left join classoa_teacher t on cc.teacher_id=t.teacher_id left join classoa_classroom cr on cc.classroom_id=cr.classroom_id where cc.inst_id=%d and cc.status=0 order by cc.class_id desc limit %d,%d";
        return $this->query($sql,$instId,$start,$pageSize);
    }
    
    public function showClassDetails($classId,$tId){
        $sql = "select cd.*,ct.name teacher_name,cc.name classroom_name from classoa_class_detail cd left join classoa_teacher ct on cd.teacher_id=ct.teacher_id left join classoa_classroom cc on cd.classroom_id=cc.classroom_id where cd.class_id=%d and cd.inst_id=%d and cd.status=0 order by cd.date asc,cd.start_time_int asc";
        return $this->query($sql,$classId,$tId);
    }

    public function showClassDetail($classDetailId,$tId){
        $sql = "select cd.*,cc.class_name class_name from classoa_class_detail cd left join classoa_class cc on cd.class_id=cc.class_id where cd.class_detail_id=%d and cd.inst_id=%d";
        return $this->query($sql,$classDetailId,$tId);
    }

    public function showClassDetailsById($classId,$tId){
        $sql = "select * from classoa_class_detail where class_id=%d and inst_id=%d and status=0 order by date asc,start_time_int asc";
        return $this->query($sql,$classId,$tId);
    }

    public function updateClassDetail($date,$year,$month,$dayOfWeek,$startTime,$startTimeInt,$endTime,$teacherId,$classroomId,$classDetailId,$tId){
        $sql = "update classoa_class_detail set date='%s',year='%s',month=%d,day_of_week=%d,start_time='%s',start_time_int=%d,end_time='%s',teacher_id=%d,classroom_id=%d where class_detail_id=%d and inst_id=%d";
        return $this->execute($sql,$date,$year,$month,$dayOfWeek,$startTime,$startTimeInt,$endTime,$teacherId,$classroomId,$classDetailId,$tId);
    }

    public function updateClassDetailIsAbsentCheck($classDetailId,$tId,$isAbsentCheck){
        $sql = "update classoa_class_detail set is_absent_check=%d where class_detail_id=%d and inst_id=%d";
        return $this->execute($sql,$isAbsentCheck,$classDetailId,$tId);
    }

    public function deleteClassDetail($classId,$classDetailId,$tId){
        $sql = "update classoa_class_detail set status=1 where class_detail_id=%d and class_id=%d and inst_id=%d";
        return $this->execute($sql,$classDetailId,$classId,$tId);
    }

    public function deleteClassDetails($classId,$tId){
        $sql = "update classoa_class_detail set status=1 where class_id=%d and inst_id=%d";
        return $this->execute($sql,$classId,$tId);
    }

    public function showClassesByTeacher($tId,$year,$month,$teacherId){
        $sql = "select d.*,c.class_name class_name,r.name classroom_name from classoa_class_detail d left join classoa_class c on d.class_id=c.class_id left join classoa_classroom r on d.classroom_id=r.classroom_id where d.inst_id=%d and d.year='%s' and d.month='%s' and d.teacher_id=%d and d.status=0 order by d.date asc,d.start_time_int asc";
        return $this->query($sql,$tId,$year,$month,$teacherId);
    }

    public function showDailyClassesByTeacher($tId,$ymd,$teacherId){
        $sql = "select d.*,c.class_name class_name,r.name classroom_name from classoa_class_detail d left join classoa_class c on d.class_id=c.class_id left join classoa_classroom r on d.classroom_id=r.classroom_id where d.inst_id=%d and d.date='%s' and d.teacher_id=%d and d.status=0 order by d.date asc,d.start_time_int asc";
        return $this->query($sql,$tId,$ymd,$teacherId);
    }

    public function showClassesByClassroom($tId,$year,$month,$classroomId){
        $sql = "select * from classoa_class_detail where inst_id=%d and year='%s' and month='%s' and classroom_id=%d and status=0 order by date asc,start_time asc";
        return $this->query($sql,$tId,$year,$month,$classroomId);
    }

    public function updateStudentStatusFromClassDetail($tId,$classId,$classDetailId,$studentId,$status){
        $sql = "update classoa_class_detail_student_rela set status=%d where class_detail_id=%d and class_id=%d and inst_id=%d and student_id=%d";
        return $this->execute($sql,$status,$classDetailId,$classId,$tId,$studentId);
    }

    ////////////////////////////////////
    ////////////classtype///////////////
    ////////////////////////////////////
    public function saveClasstype($classtype,$instId){
        $sql = "insert into classoa_classtype(name,inst_id) values('%s',%d)";
        return $this->execute($sql,$classtype,$instId);
    }
    
    public function totalClasstypes($instId){
    	$sql = "select count(1) total from classoa_classtype where inst_id=%d and status=0";
        return $this->query($sql,$instId);
    }

    public function showClassTypes($instId,$start,$pageSize){
        $sql = "select * from classoa_classtype where inst_id=%d and status=0 order by id desc limit %d,%d";
        return $this->query($sql,$instId,$start,$pageSize);
    }

    public function deleteClassType($instId,$classTypeId){
    	$sql = "update classoa_classtype set status=1 where id=%d and inst_id=%d";
    	return $this->execute($sql,$classTypeId,$instId);
    }
}

