<?php
namespace Home\Controller;
use Think\Controller;
class FinanceController extends Controller {

    public function showFinanceDetail($ym){
        if($ym == null || $ym == ""){
            $ym = date('Y-m');
        }

        $ymArr = explode('-',$ym);
        $year = $ymArr[0];
        $month = $ymArr[1];

        $instId = session('instId');

        $model = new \Home\Model\FinanceModel();
        $allClassDetails = $model->getAllClassDetailsByMonth($year,(int)$month,$instId);

        for($i=0;$i<count($allClassDetails);$i++){
            $classDetail = $allClassDetails[$i];
            $classId = $classDetail['class_id'];
            $classDetailId = $classDetail['class_detail_id'];
            
            if(empty($classList[$classId])){
                $tuitions = $model->getTuitionsByClassDetailId($classDetailId,$classId,$instId);
                $classInfo = array("className"=>$classDetail["class_name"],"classType"=>$classDetail["class_type_name"],"classTimes"=>1,"classTypeId"=>$classDetail["class_type_id"],"tuitions"=>$tuitions[0]['sum']);
                $classList[$classId] = $classInfo;
            }else{
                $classInfo = $classList[$classId];
                $classTimes = $classInfo['classTimes'];
                $classInfo["classTimes"] = $classTimes+1;
                $tuitions = $model->getTuitionsByClassDetailId($classDetailId,$classId,$instId);
                $allTuitions = $classInfo['tuitions'];
                $classInfo['tuitions'] = $allTuitions + $tuitions[0]['sum'];
                $classList[$classId] = $classInfo;
            }
        }


        $this->assign("classList",$classList);

        //年月list  页面显示用
        $ymList = array();
        $currym = date('Y-m');
        for($i=0;$i<6;$i++){
            $nextmonth=date('Y-m',strtotime("$currym - ".$i." month"));
            array_push($ymList,$nextmonth);
        }
        $this->assign("ymList",$ymList);

        layout(true);
        $this->display();
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