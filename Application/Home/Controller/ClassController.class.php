<?php
namespace Home\Controller;
use Think\Controller;
class ClassController extends Controller {

    //////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////CLASS//////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////

    public function addClass(){
        //inst_Id
        $tId = session('instId');

        $classtype = new \Home\Model\ClassModel();
        $classtypeList = $classtype->showClassTypes($tId,0,500);
        $this->assign("classtypeList",$classtypeList);
        $cnum=0;
        $this->assign("cnum",$cnum);

        $teacher = new \Home\Model\TeacherModel();
        $teacherList = $teacher->showTeachers($tId,0,50);   
        $this->assign("teacherList",$teacherList);
        $tnum=0;
        $this->assign("tnum",$tnum);

        $classroom = new \Home\Model\ClassroomModel();
        $classroomList = $classroom->showClassrooms($tId,0,20);   
        $this->assign("classroomList",$classroomList);
        $clnum=0;
        $this->assign("clnum",$clnum);

        $student = new \Home\Model\StudentModel();
        $studentList = $student->showStudents($tId,0,20);   
        $this->assign("studentList",$studentList);
        $snum=0;
        $this->assign("snum",$snum);

        layout(true);
        $this->display();
    }

    public function saveClass($className="",$classtypeId,$teacherId,$classroomId,$studentIds="1|2|3",$startDate="",$endDate="",$time="1|9:00-11:00;3|9:00-11:00",$tuition,$remark){

        //inst_Id
        $tId = session('instId');

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
            if($dayOfWeek == 0)
                $dayOfWeek = 7;
            if($classTimeArr[$dayOfWeek-1] != ""){//has class on that day
                $date = date("Y-m-d", $start) ;
                $ymd = explode('-',$date);
                $year = $ymd[0];
                $month = $ymd[1];
                $times = explode('-',$classTimeArr[$dayOfWeek-1]);
                $startTime = $times[0];
                $endTime = $times[1];
                //save class detail
                $classDetailId = $class->saveClassDetail($date,$year,$month,$dayOfWeek,$startTime,$endTime,$teacherId,$classroomId,$classId,$tuition,$tId);

                //save students that join this class
                for($i=0;$i<count($students);$i++){
                    $class->saveClassDetailAndStudentRela($classDetailId,$classId,$students[$i],$tuition,$tId);
                }
            }
            $start += $oneDay;//check next day
        }
        $this->ajaxReturn("ok");
    }

    public function updateClass($classId,$className){
        //inst_Id
        $tId = session('instId');
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
        $tId = session('instId');
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
        $tId = session('instId');
        $class = new \Home\Model\ClassModel();
        $result = $class->showClassDetails($classId,$tId);
        $this->assign('classDetails',$result);//记录编号
        layout(true);
        $this->display();
    }

    //apply context: when a class detail needs to be added
    public function addClassDetail(){

    }

    //apply context: when one class detail needs to change classroom, a teacher, date, time.
    public function updateClassDetail($classId,$classDetailId,$classroomId,$teacherId,$date="2015-01-05",$startTime="10:00",$endTime="12:00",$tuition){
        //inst_Id
        $tId = session('instId');
        $ymd = explode('-',$date);
        $year = $ymd[0];
        $month = $ymd[1];
        $dayOfWeek = date('w',strtotime($date));
        $result = $class->updateClassDetail($date,$year,$month,$dayOfWeek,$startTime,$endTime,$teacherId,$classroomId,$classId,$tuition,$tId);
        if($result == 1){
           $data = 'ok'; 
        }else{
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    //apply context: when you want to delete one class detail.
    public function delClassDetail($classId,$classDetailId){
        //inst_Id
        $tId = session('instId');
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
        //inst_Id
        $tId = session('instId');
        //students
        $students = explode('|',$studentIds);
        $class = new \Home\Model\ClassModel();
        //save students that join this class
        for($i;$i<count($students);$i++){
            $class->saveClassDetailAndStudentRela($classDetailId,$classId,$students[$i],null,$tId);
        }
    }

    //del students from on classdetail
    //apply context: record  absent
    public function delStudentsFromClassDetail($classId,$classDetailId,$studentIds){
        //inst_Id
        $tId = session('instId');
        //students
        $students = explode('|',$studentIds);
        $class = new \Home\Model\ClassModel();
        //save students that join this class
        for($i;$i<count($students);$i++){
            $class->delClassDetailAndStudentRela($classDetailId,$students[$i],$tId);
        }
    }

    //showcase of the classes of a teacher or a classroom in a month
    public function showClasses($teacherId=null,$classroomId=null,$ym){
        //inst_Id
        $tId = session('instId');
        $class = new \Home\Model\ClassModel();
        $yearAndMonth = explode("-",$ym);
        $year = $yearAndMonth[0];
        $month = $yearAndMonth[1];
        $result;
        if($teacherId!=null)
            $result = $class->showClassesByTeacher($tId,$year,$month,$teacherId);
        if($classroomId!=null)
            $result = $class->showClassesByClassroom($tId,$year,$month,$classroomId);

        $monthly = array();
        $weekly;
        $daily;
        $currDay;
        for($i=0;$i<count($result);$i++){
            $class = $result[$i];
            $date = $class['date'];
            $month = $class['month'];
            $dayOfMonth = explode('-',$date)[2];
            $dayOfWeek = $class['day_of_week'];
            $startTime = $class['start_time'];
            $endTime = $class['end_time'];
            $className = $class['class_name'];
            $classroomName = $class['classroom_name'];

            $perClass = array("month"=>$month,"dayOfMonth"=>$dayOfMonth,"dayOfWeek"=>$dayOfWeek,"startTime"=>$startTime,"endTime"=>$endTime,"className"=>$className,"classroomName"=>$classroomName);
            if($currDay != $dayOfMonth){//a new day
                $currDay = $dayOfMonth;
                $daily = array();
                if($dayOfWeek == 1){//a new week
                    $weekly = array();
                    array_push($monthly, $weekly);
                }
                array_push($weekly, $daily);
            }
            array_push($daily,$perClass);
        }

        $this->assign('monthlyClasses',$monthly);//记录编号
        layout(true);
        $this->display();
    }





    //////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////CLASSTYPE///////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////

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