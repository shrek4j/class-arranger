<?php
namespace Home\Controller;
use Think\Controller;
class TeacherController extends Controller {

    public function addTeacher(){
        layout(true);
        $this->display();
    }

    public function saveTeacher($teacher,$loginname){
        if($teacher == "")
            return;
        $instId = session('instId');

        $model = new \Home\Model\TeacherModel();
        $operator = new \Home\Model\OperatorModel();
        try {
            $model->startTrans();
            $result = $model->saveTeacher($teacher,$instId);
            //TODO 稍后改成用户自定义密码
            $operatorId = $operator->addOperator($instId,$loginname,'123456',0,$teacher,$result[0]['teacher_id']);
            //TODO 稍后改成查数据库code=ROLE_TEACHER的
            $operator->addOperatorAndRoleRela($operatorId[0]['operator_id'],1);
            $model->commit();
            $data = "true";
        } catch (Exception $e) {
            $model->rollback();
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
        $operator = new \Home\Model\OperatorModel();
        try {
            $model->startTrans();
            $result = $model->deleteTeacher($instId,$teacherId);
            $operator->deleteOperatorByTeacherId($instId,$teacherId);
            $model->commit();
            $data = "true";
        }catch(Exception $e){
            $model->rollback();
            $data = "false";
        }
        $this->ajaxReturn($data);
    }


}