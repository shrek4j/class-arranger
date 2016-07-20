<?php
namespace Home\Controller;
use Think\Controller;

define("TO_HACKERS","stop fucking around");

class RoleController extends Controller {

    public function showAddOperator(){
        $instId = session('instId');
        
        $teacher = new \Home\Model\TeacherModel();
        $teacherList = $teacher->showTeachersForRole($instId,0,50);   
        $this->assign("teacherList",$teacherList);
        $tnum=0;
        $this->assign("tnum",$tnum);

        $role = new \Home\Model\RoleModel();
        $roles = $role->showRoles();
        $this->assign("roles",$roles);
        $rnum=0;
        $this->assign("rnum",$rnum);
        
        layout(true);
        $this->display();
    }

    //为已有的教师初始化数据！！！！！
    //`real_name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
    //`teacher_id` int(10) DEFAULT 0 NOT NULL,
    //`status` int(1) DEFAULT 0 NOT NULL,
    public function saveOperator($realName,$userName,$userPwd,$roles,$teacher){
        $instId = session('instId');
        try{
            $operator = new \Home\Model\OperatorModel();
            $operator->startTrans();
            $operatorId = $operator->addOperator($instId,$userName,$userPwd,0,$realName,$teacher);
            $roleIds = explode('|',$roles);
            for($i=0;$i<count($roleIds);$i++){
                $operator->addOperatorAndRoleRela($operatorId[0]['operator_id'],(int)$roleIds[$i]);
            }
            $operator->commit();
            $data = "true";
        }catch(Exception $e){
            $operator->rollback();
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showOperatorList($pageNo=1,$pageSize=10){
        $instId = session('instId');
        $start = ($pageNo - 1)*$pageSize;
        $operator = new \Home\Model\OperatorModel();
        $operatorList = $operator->showOperators($instId,$start,$pageSize);
        $totals = $operator->total($instId);
        $total = $totals[0]['total'];
        $this->assign('operatorList',$operatorList);
        $this->assign('total',$total);
        $this->assign('pageNo',$pageNo);
        $this->assign('pageSize',$pageSize);
        $this->assign("howMangPages",ceil($total/$pageSize-1)+1);
        $this->assign('num',1);//记录编号
        layout(true);
        $this->display();
    }

    public function deleteOperator($operatorId){
        $instId = session('instId');
        try{
            $operator = new \Home\Model\OperatorModel();
            $result = $operator->deleteOperator($instId,$operatorId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function toggleDisabled($operatorId,$disabled){
        $instId = session('instId');
        try{
            $operator = new \Home\Model\OperatorModel();
            $result = $operator->toggleDisabled($instId,$operatorId,$disabled);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showEditSA(){
        $instId = session('instId');
        $isSuperAdmin = session('isSuperAdmin');
        if($isSuperAdmin != 1){
            echo TO_HACKERS;
        }
        $operator = new \Home\Model\OperatorModel();
        $result = $operator->showSuperAdmin($instId);
        $this->assign('superAdmin',$result[0]);

        $teacher = new \Home\Model\TeacherModel();
        $teacherList = $teacher->showTeachers($instId,0,50);   
        $this->assign("teacherList",$teacherList);
        $tnum=0;
        $this->assign("tnum",$tnum);

        layout(true);
        $this->display();
    }

    public function editSuperAdmin($teacher){
        $instId = session('instId');
        try{
            $operator = new \Home\Model\OperatorModel();
            $operatorId = $operator->updateSuperAdmin($instId,$teacher);
            session('teacherId',$teacher);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }
}