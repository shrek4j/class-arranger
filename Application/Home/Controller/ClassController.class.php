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

    public function saveClass($className="",$classtypeId,$teacherId,$classroomId,$studentIds="",$startDate="",$endDate="",$time="",$tuition,$remark){

        //inst_Id
        $tId = session('instId');

        //handle time format
        $classTimeArr = array("","","","","","","");
        $timeArr = explode(';',$time);
        for($x=0;$x<count($timeArr)-1;$x++) {
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
                $classDetailId = $class->saveClassDetail($date,$year,$month,$dayOfWeek,$startTime,$endTime,$teacherId,$classroomId,$classId[0]['class_id'],$tuition,$tId);

                //save students that join this class
                for($i=0;$i<count($students);$i++){
                    $class->saveClassDetailAndStudentRela($classDetailId[0]['class_detail_id'],$classId[0]['class_id'],(int)$students[$i],(int)$tuition,$tId);
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
    public function showClasses($teacherId=0,$classroomId=0,$ym){

         //inst_id
        $tId = session('instId');
        
        $teacher = new \Home\Model\TeacherModel();
        $teacherList = $teacher->showTeachers($tId,0,50);   
        $this->assign("teacherList",$teacherList);

        $classroom = new \Home\Model\ClassroomModel();
        $classroomList = $classroom->showClassrooms($tId,0,20);   
        $this->assign("classroomList",$classroomList);

        //年月list
        $ymList = array();
        $currym = date('Y-m');
        for($i=0;$i<6;$i++){
            $nextmonth=date('Y-m',strtotime("$currym + ".$i." month"));
            array_push($ymList,$nextmonth);
        }
        $this->assign("ymList",$ymList);

        if(($teacherId != 0 || $classroomId != 0) && $ym != null){
            $class = new \Home\Model\ClassModel();
            $yearAndMonth = explode("-",$ym);
            $year = $yearAndMonth[0];
            $month = $yearAndMonth[1];
            $result;
            if($teacherId!=0){
                $result = $class->showClassesByTeacher($tId,$year,(int)$month,$teacherId);
            }
           // else if($classroomId!=0)
           //     $result = $class->showClassesByClassroom($tId,$year,$month,$classroomId);

            $nextmonth=date('Y-m-d',strtotime("$ym + 1 month"));
            $daysInMonth = date('d',strtotime($nextmonth)-24*3600);
            $lastDayInWeek = date('w',strtotime($nextmonth)-24*3600);
            $firstDayInWeek = date('w',strtotime($ym));
            if($lastDayInWeek == 0)
                $lastDayInWeek = 7;

            //设定空集合
            $newResult = array();
            for($n=0;$n<$daysInMonth;$n++){
                $nullDay = array();
                $nullDay['date'] = date('Y-m-d',strtotime("$ym + ".$n." day"));
                $nullDay['day_of_week'] = $firstDayInWeek;

                $firstDayInWeek++;
                if($firstDayInWeek==8)
                    $firstDayInWeek = 1;
                $newResult[$n]=$nullDay;
            }

            //填充有效数据
            for($n=0;$n<count($newResult);$n++){
                $day = $newResult[$n];
                $date = $day['date'];
                for($m=0;$m<count($result);$m++){
                    if($date == $result[$m]['date']){
                        $newResult[$n] = $result[$m];
                    }
                }
            }

            //组装成表格的格式
            $monthly = array();
            $weekly;
            $daily;
            $currDay;
            $currDayOfWeek;
            $perClass;
            for($i=0;$i<count($newResult);$i++){
                $class = $newResult[$i];
                $date = $class['date'];
                $month = $class['month'];
                $ymd = explode('-',$date);
                $dayOfMonth = $ymd[2];
                $dayOfWeek = $class['day_of_week'];
                $startTime = $class['start_time'];
                $endTime = $class['end_time'];
                $className = $class['class_name'];
                $classroomName = $class['classroom_name'];
                if($className != null){
                    $perClass = array("month"=>$month,"dayOfMonth"=>$dayOfMonth,"dayOfWeek"=>$dayOfWeek,"startTime"=>$startTime,"endTime"=>$endTime,"className"=>$className,"classroomName"=>$classroomName);
                }else{
                    $perClass = array("month"=>$month,"dayOfMonth"=>$dayOfMonth,"dayOfWeek"=>$dayOfWeek);
                }
                if($currDay != $dayOfMonth){//a new day
                    $currDay = $dayOfMonth;
                    $isNextDay = true;
                    $daily = array();
                    if($isNextDay && ($currDayOfWeek >= $dayOfWeek)){//a new week
                        $weekly = array();
                        array_push($monthly, &$weekly);//php区分值传递和引用传递！！
                    }
                    $currDayOfWeek = $dayOfWeek;
                    //补全上个月
//                    if($dayOfMonth==1 && $dayOfWeek > 1){
 //                       for($n=1;$n<$firstDayInWeek;$n++){
 //                           $nullDay = array();
 //                           array_push($weekly,&$nullDay);
 //                       }
 //                   }
                    array_push($weekly, &$daily);
                }
                
                array_push($daily,&$perClass);//添加月内数据
                //补全下个月
 //               if($dayOfMonth == $daysInMonth && $dayOfWeek < 7){
  //                  for($n=$lastDayInWeek+1;$n<=7;$n++){
  //                      $nullDay = array();
   //                     array_push($weekly,&$nullDay);
   //                 }
  //              }
            }
die;
            print_r($monthly);die;

            $dayCounter = 1;
            $this->assign('monthlyClasses',$monthly);//记录编号
            $this->assign('dayCounter',$dayCounter);
        }
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