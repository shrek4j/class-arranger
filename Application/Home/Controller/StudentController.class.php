<?php
namespace Home\Controller;
use Think\Controller;
class StudentController extends Controller {
    
    public function addStudent(){
        layout(true);
        $this->display();
    }

    public function saveStudent($studentName="",$gender,$grade,$school,$parentName,$mobile,$tuition){
        if($studentName == "")
            return;
        $pyUtil = new \Org\Util\Pinyin();
        $studPinyin = $pyUtil->getPinyin($studentName);
        $instId = session('instId');
        if(!$instId)
            return;
        $model = new \Home\Model\StudentModel();
        $result = $model->saveStudent($studentName,$studPinyin,$gender,$grade,$school,$parentName,$mobile,$tuition,$instId);
        $data;
        if($result == 1){
           $data = 'ok'; 
        }else{
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
        if(!$instId)
            return;
        $model = new \Home\Model\StudentModel();
        $result = $model->deleteStudent($instId,$studentId);
        if($result == 1){
           $data = 'ok'; 
        }else{
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

}