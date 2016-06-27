<?php
namespace Home\Controller;
use Think\Controller;
class RoleController extends Controller {

    public function showAddOperator(){
        $instId = session('instId');
        
        $teacher = new \Home\Model\TeacherModel();
        $teacherList = $teacher->showTeachers($instId,0,50);   
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

}