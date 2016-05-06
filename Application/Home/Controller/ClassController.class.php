<?php
namespace Home\Controller;
use Think\Controller;
class ClassController extends Controller {

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////CLASS//////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////

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
                $ymd = explode('-',$date);
                $month = intval($ymd[1]);
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

    public function updateClass($classId,$className){
        //inst_Id
        $tId = session('tId');
        $class = new \Home\Model\ClassModel(); 
        $result = $class->updateClass($classId,$className,$tId);
        if($result == 1){
           $data = 'ok'; 
        }else{
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function delClass($classId){
        //inst_Id
        $tId = session('tId');
        $class = new \Home\Model\ClassModel(); 
        $result = $class->delClass($classId,$tId);
        if($result == 1){
           $data = 'ok'; 
        }else{
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showClassDetails($classId){
        //inst_Id
        $tId = session('tId');
        $class = new \Home\Model\ClassModel();
        $result = $class->showClassDetails($classId,$tId);
        $this->assign('classDetails',$result);//记录编号
        layout(true);
        $this->display();
    }

    //apply context: when a class detail needs to be added
    public function addClassDetail(??){

    }

    //apply context: when one class detail needs to change classroom, a teacher, date, time.
    public function updateClassDetail($classId,$classDetailId,$classroomId,$teacherId,$date="2015-01-05",$startTime="10:00",$endTime="12:00"){
        
    }

    //apply context: when you want to delete one class detail.
    public function delClassDetail($classId,$classDetailId){
        //inst_Id
        $tId = session('tId');
        $class = new \Home\Model\ClassModel(); 
        $result = $class->delClassDetail($classId,$classDetailId,$tId);
        if($result == 1){
           $data = 'ok'; 
        }else{
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    //add students to classdetails that hasn't yet begun
    //apply context: the students want to join the class which may begin in the future or may has begun.
    //               in this case, the students will attend the classdetails that hasn't finished.
    public function addStudentsIntoClass($classId,$studentIds){

    }

    //del students from classdetails that hasn't yet begun
    //apply context: the students want to quit this class.
    public function delStudentsFromClass($classId,$studentIds){

    }

    //add students to one classdetail
    //apply context: record not absent
    public function addStudentsIntoClassDetail($classId,$classDetailId,$studentIds){

    }

    //del students from on classdetail
    //apply context: record  absent
    public function delStudentsFromClassDetail($classId,$classDetailId,$studentIds){

    }


    //showcase of the classes of a teacher or a classroom in a month
    public function showClasses(){
        
        layout(true);
        $this->display();
    }





    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////CLASSTYPE//////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////

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