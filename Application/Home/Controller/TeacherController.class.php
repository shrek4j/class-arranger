<?php
namespace Home\Controller;
use Think\Controller;
class TeacherController extends Controller {

    public function addTeacher(){
        layout(true);
        $this->display();
    }

    public function saveTeacher($teacher){
        if($teacher == "")
            return;
        $instId = session('instId');
        if(!$instId)
            return;
        $model = new \Home\Model\TeacherModel();
        $result = $model->saveTeacher($teacher,$instId);
        if($result == 1){
           $data = 'ok'; 
        }else{
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showTeachers($pageNo=1,$pageSize=10){
        $instId = session('instId');
        if(!$instId)
            return;
        $start = ($pageNo - 1)*$pageSize;
        $model = new \Home\Model\TeacherModel();
        $teacherList = $model->showTeachers($instId,$start,$pageSize);
        $totals = $model->total($instId);
        $total = $totals[0]['total'];
        $this->assign('teacherList',$teacherList);
        $this->assign('total',$total);
        $this->assign('pageNo',$pageNo);
        $this->assign('pageSize',$pageSize);
        $this->assign("howMangPages",ceil($total/$pageSize-1)+1);
        $this->assign('num',1);//记录编号
        layout(true);
        $this->display();
    }

    public function deleteTeacher($teacherId){
        $instId = session('instId');
        if(!$instId)
            return;
        $model = new \Home\Model\TeacherModel();
        $result = $model->deleteTeacher($instId,$teacherId);
        if($result == 1){
           $data = 'ok'; 
        }else{
            $data = "false";
        }
        $this->ajaxReturn($data);
    }


}