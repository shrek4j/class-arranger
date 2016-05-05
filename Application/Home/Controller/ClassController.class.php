<?php
namespace Home\Controller;
use Think\Controller;
class ClassController extends Controller {

    public function addClass($classname="",$classtypeId,$teacherId,$classroomId,$studentIds="1|2|3",$startDate="",$endDate="",$time="1|9:00-11:00;3|9:00-11:00",$tuition,$remark){

        //inst_Id
        $tId = session('tId');

        //handle time format
        $classTimeArr = array("","","","","","","");
        $timeArr = explode(';',$time);
        for($x=0;$x<count($timeArr);$x++) {
            $tuple = explode('|',$timeArr[$x]);
            $classTimeArr[$tuple[0]-1] = $tuple[1];
        }

        //translate
        $start = strtotime($startDate);
        $end = strtotime($endDate);
        $oneDay = 24*3600;

        //students
        $students = explode('|',$studentIds);

        //save class
        $class = new \Home\Model\ClassModel(); 
        $classId = $class->saveClass($className,$classtypeId,$remark,$tId);

        while($start < $end){
            $dayOfWeek = date('w',$start);//get the dayOfWeek of this timestamp
            if($classTimeArr[$dayOfWeek-1] != ""){//has class on that day
                $date = date("Y-m-d", $start) ;
                $month = intval(explode('-',$date)[1]);
                $times = explode('-',$classTimeArr[$dayOfWeek-1]);
                $startTime = $times[0];
                $endTime = $times[1];
                //save class detail
                $classDetailId = $class->saveClassDetail($date,$month,$dayOfWeek,$startTime,$endTime,$teacherId,$classroomId,$classId,$tuition,$tId);

                //save students that join this class
                for($i;$i<count($students);$i++){
                    $class->saveClassDetailAndStudentRela($classDetailId,$classId,$students[i],$tuition,$tId);
                }
            }
            
            $start += $oneDay;//check next day
        }

    }

    public function updateClass(){

    }

    public function delClass($classId){

    }

    public function showClasses(){
        
        layout(true);
        $this->display();
    }

    public function showClassDetail($classId){

    }



    /////////////////////////////////////////////////////
    /////////////////////classtype///////////////////////
    /////////////////////////////////////////////////////

    public function addClassType(){
        layout(true);
        $this->display();
    }

    public function saveClassType($classtype){
        if($classtype == "")
            return;
        $instId = session('instId');
        if(!$instId)
            return;
        $model = new \Home\Model\ClassModel();
        $result = $model->saveClasstype($classtype,$instId);
        if($result == 1){
           $data = 'ok'; 
        }else{
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showClassTypes($pageNo=1,$pageSize=10){
        $instId = session('instId');
        if(!$instId)
            return;
        $start = ($pageNo - 1)*$pageSize;
        $model = new \Home\Model\ClassModel();
        $classtypeList = $model->showClassTypes($instId,$start,$pageSize);
        $totals = $model->total($instId);
        $total = $totals[0]['total'];
        $this->assign('classtypeList',$classtypeList);
        $this->assign('total',$total);
        $this->assign('pageNo',$pageNo);
        $this->assign('pageSize',$pageSize);
        $this->assign("howMangPages",ceil($total/$pageSize-1)+1);
        $this->assign('num',1);//记录编号
        layout(true);
        $this->display();
    }

    public function deleteClassType($classTypeId){
        $instId = session('instId');
        if(!$instId)
            return;
        $model = new \Home\Model\ClassModel();
        $result = $model->deleteClassType($instId,$classTypeId);
        if($result == 1){
           $data = 'ok'; 
        }else{
            $data = "false";
        }
        $this->ajaxReturn($data);
    }


}