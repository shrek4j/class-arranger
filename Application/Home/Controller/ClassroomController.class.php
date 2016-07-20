<?php
namespace Home\Controller;
use Think\Controller;
class ClassroomController extends Controller {

    public function addClassroom(){
        layout(true);
        $this->display();
    }

    public function saveClassroom($classroom,$rent){
        if($classroom == "")
            return;
        $instId = session('instId');

        try{
            $model = new \Home\Model\ClassroomModel();
            $result = $model->saveClassroom($classroom,(int)$rent*100,$instId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showClassrooms($pageNo=1,$pageSize=10){
        $instId = session('instId');
        if(!$instId)
            return;
        $start = ($pageNo - 1)*$pageSize;
        $model = new \Home\Model\ClassroomModel();
        $classroomList = $model->showClassrooms($instId,$start,$pageSize);
        $totals = $model->total($instId);
        $total = $totals[0]['total'];
        $this->assign('classroomList',$classroomList);
        $this->assign('total',$total);
        $this->assign('pageNo',$pageNo);
        $this->assign('pageSize',$pageSize);
        $this->assign("howMangPages",ceil($total/$pageSize-1)+1);
        $this->assign('num',1);//记录编号
        layout(true);
        $this->display();
    }

    public function deleteClassroom($classroomId){
        $instId = session('instId');
        try{
            $model = new \Home\Model\ClassroomModel();
            $result = $model->deleteClassroom($instId,$classroomId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }


}