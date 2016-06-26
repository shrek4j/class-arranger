<?php
namespace Home\Model;
use Think\Model;
class FinanceModel extends Model {
    protected $connection = 'DB_CONFIG1';//调用配置文件中的数据库配置1
    protected $autoCheckFields = false;//模型和数据表无需一一对应
    
    public function getAllClassDetailsByMonth($year,$month,$instId){
        $sql = "SELECT ccd.class_detail_id,ccd.class_id,ccd.teacher_id,cc.class_name,cc.class_type_id,cc.wage wage,c.name class_type_name,ct.name teacher_name FROM classoa_class_detail ccd LEFT JOIN classoa_class cc ON ccd.class_id=cc.class_id LEFT JOIN classoa_classtype c ON cc.class_type_id=c.id LEFT JOIN classoa_teacher ct ON ccd.teacher_id=ct.teacher_id WHERE ccd.inst_id=%d AND ccd.STATUS=0 AND ccd.year='%s' AND ccd.month='%s' order by cc.class_type_id asc";
        return $this->query($sql,$instId,$year,$month);
    }

    public function getTuitionsByClassDetailId($classDetailId,$classId,$instId){
        $sql = "SELECT sum(tuition_per_class) sum FROM classoa_class_detail_student_rela WHERE class_detail_id=%d AND class_id=%d AND inst_id=%d and status=0 and is_absent=0";
        return $this->query($sql,$classDetailId,$classId,$instId);
    }

    public function getClassroomRents($instId){
        $sql = "SELECT name,rent_per_month from classoa_classroom WHERE inst_id=%d AND status=0";
        return $this->query($sql,$instId);
    }
}

