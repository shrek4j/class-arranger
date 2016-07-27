<?php
namespace Home\Controller;
use Think\Controller;
class StudentController extends Controller {
    
    public function addStudent(){
        $instId = session('instId');
        $classtype = new \Home\Model\ClassModel();
        $classtypeList = $classtype->showClassTypes($instId,0,500);
        $this->assign("classtypeList",$classtypeList);

        $class = new \Home\Model\ClassModel();
        $classList = $class->showClassList($instId,0,100);
        $this->assign('classList',$classList);

        $tnum=0;
        $this->assign('tnum',$tnum);
        
        layout(true);
        $this->display();
    }

    //still need tuition per class
    //classoa_student:  interested_class int(10) classtype_id
    public function saveStudent($studentName="",$gender,$grade,$school,$remark,$mobile,$tuition,$interest,$attended){
        try{
            if($studentName == "")
                return;
            $pyUtil = new \Org\Util\Pinyin();
            $studPinyin = $pyUtil->getPinyin($studentName);
            $instId = session('instId');
        
            $studentModel = new \Home\Model\StudentModel();
            $classModel = new \Home\Model\ClassModel();
            $studentModel->startTrans();

            //save student
            $studentIdArr = $studentModel->saveStudent($studentName,$studPinyin,$gender,$grade,$school,$remark,$mobile,$tuition*100,$instId,$interest);
            $studentId = (int)$studentId[0]['student_id'];
            
            //保存报名课程信息
            if(!empty($attended)){
                $classId = $attended;
                //$classInfo = $classModel->getClassById((int)$classId,$instId);
                //$tuition = $classInfo[0]['tuition_per_class'];

                $classDetails = $classModel->showClassDetailsById((int)$classId,$instId);
                $ndate = date("Y-m-d");
                $nstarttimeint = (int)(str_replace(':','',date('H:i')));
                for($i=0;$i<count($classDetails);$i++){
                    $cdate = $classDetails[$i]['date'];
                    $cstarttimeint = $classDetails[$i]['start_time_int'];
                    if((($cdate == $ndate) && ($cstarttimeint>$nstarttimeint)) || ($cdate > $ndate)){
                        $leftClassDetails = array_slice($classDetails, $i);
                        break;
                    }
                }

                //update student status
                $studentModel->changeStudentStatus($studentId,$instId,2);
                //save student fee info
                $class->saveClassAndStudentRela((int)$classId,$studentId,$tuition,0,$instId);
                if(!empty($leftClassDetails) && count($leftClassDetails)>0){
                    for($m=0;$m<count($leftClassDetails);$m++){
                        //add student and classDetail rela
                        $class->saveClassDetailAndStudentRela($leftClassDetails[$m]['class_detail_id'],(int)$classId,$studentId,$tuition,$instId);
                    }
                }
            }
            $data = "true";
            $studentModel->commit();
        }catch(Exception $e){
            $data = "false";
            $studentModel->rollback();
        }
        $this->ajaxReturn($data);
    }

    public function updateStudent($studentName="",$gender,$grade,$school,$remark,$mobile,$balance,$studentId){
        try{
            if($studentName == "")
                return;
            $pyUtil = new \Org\Util\Pinyin();
            $studPinyin = $pyUtil->getPinyin($studentName);
            $instId = session('instId');
        
            $model = new \Home\Model\StudentModel();
            $result = $model->updateStudent($studentName,$studPinyin,$gender,$grade,$school,$remark,$mobile,$balance*100,$studentId,$instId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showStudents($pageNo=1,$pageSize=10){
        $instId = session('instId');
        if(!$instId)
            return;
        $start = ($pageNo - 1)*$pageSize;
        $model = new \Home\Model\StudentModel();
        $studentList = $model->showStudents($instId,$start,$pageSize);
        $totals = $model->total($instId);
        $total = $totals[0]['total'];
        $this->assign('studentList',$studentList);
        $this->assign('total',$total);
        $this->assign('pageNo',$pageNo);
        $this->assign('pageSize',$pageSize);
        $this->assign("howMangPages",ceil($total/$pageSize-1)+1);
        $this->assign('num',1);//记录编号
        layout(true);
        $this->display();
    }

    public function showStudentDetail($studentId){
        $instId = session('instId');
        if(!$instId)
            return;
        $model = new \Home\Model\StudentModel();
        $student = $model->showStudentDetail($instId,$studentId);
        $this->assign('student',$student[0]);
        layout(true);
        $this->display();
    }

    public function deleteStudent($studentId){
        $instId = session('instId');
        
        try{
            $model = new \Home\Model\StudentModel();
            $result = $model->deleteStudent($instId,$studentId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }


}