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
        $classtypeList = $classtype->showClassTypes($tId,0,50);
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
        $studentList = $student->showStudents($tId,0,500);
        for($i=0;$i<count($studentList);$i++){
            $captial = substr($studentList[$i]['pinyin'],0,1);
            $studentList[$i]['capital'] = $captial;
        }
        $this->assign("studentList",$studentList);
        $snum=0;
        $this->assign("snum",$snum);

        layout(true);
        $this->display();
    }

    public function saveClass($className="",$classtypeId,$teacherId,$classroomId,$studentIds="",$startDate="",$endDate="",$time="",$timecn="",$tuition,$wage,$remark,$deductFlag){
        try{
            //inst_Id
            $tId = session('instId');

            $tuition = (int)$tuition*100;
            $wage = (int)$wage*100;

            //$className = iconv("utf-8","gbk//IGNORE",$className);
            //$timecn = iconv("utf-8","gbk//IGNORE",$timecn);

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
            if($studentIds == null || $studentIds == ""){
                
            }else{
                $students = explode('|',$studentIds);
            }

            //save class
            $class = new \Home\Model\ClassModel(); 
            $class->startTrans();
            $classId = $class->saveClass($className,$classtypeId,$tuition,(int)$wage,$startDate,$endDate,$teacherId,$classroomId,$remark,$deductFlag,$timecn,$tId);

            //update student status
            if(!empty($students)){
                $studentModel = new \Home\Model\StudentModel();
                for($i=0;$i<count($students);$i++){
                    $studentModel->changeStudentStatus((int)$students[$i],$tId,2);
                }
            }

            $classCount = 0;
            while($start <= $end){
                $dayOfWeek = date('w',$start);//get the dayOfWeek of this timestamp
                if($dayOfWeek == 0)
                    $dayOfWeek = 7;
                if($classTimeArr[$dayOfWeek-1] != ""){//has class on that day
                    $classCount++;
                    $date = date("Y-m-d", $start);
                    $ymd = explode('-',$date);
                    $year = $ymd[0];
                    $month = $ymd[1];
                    $times = explode('-',$classTimeArr[$dayOfWeek-1]);
                    $startTime = $times[0];
                    $endTime = $times[1];
                    $startTimeInt = str_replace(':','',$startTime);
                    //save class detail
                    $classDetailId = $class->saveClassDetail($date,$year,$month,$dayOfWeek,$startTime,(int)$startTimeInt,$endTime,$teacherId,$classroomId,$classId[0]['class_id'],$tId);

                    //save students that join this class
                    if(!empty($students)){
                        for($i=0;$i<count($students);$i++){
                            $class->saveClassDetailAndStudentRela($classDetailId[0]['class_detail_id'],$classId[0]['class_id'],(int)$students[$i],(int)$tuition,$tId);
                        }
                    }
                }
                $start += $oneDay;//check next day
            }

            $receivableTuition = $classCount*$tuition;
            //save class students 
            if(!empty($students)){
                for($i=0;$i<count($students);$i++){
                    $class->saveClassAndStudentRela($classId[0]['class_id'],(int)$students[$i],$tuition,0,$tId,$receivableTuition,0);
                }
            }

            $class->commit();
            $data = "true";
        } catch(Exception $e){
            $model->rollback();
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function getTuitionsByClassId($classId){
        $tId = session('instId');
        
    }

    public function updateClass($classId,$className){
        try{
            $tId = session('instId');
            $class = new \Home\Model\ClassModel(); 
            $result = $class->updateClass($classId,$className,$tId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function deleteClass($classId){
        try{
            $tId = session('instId');
            $class = new \Home\Model\ClassModel();
            $class->startTrans();
            $result = $class->deleteClass($classId,$tId);
    		$class->deleteClassDetails($classId,$tId);
    		$class->deleteClassDetailAndStudentRelas($classId,$tId);
            $class->commit();
            $data = "true";
        }catch(Exception $e){
            $class->rollback();
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showClassList($pageNo=1,$pageSize=10){
        //inst_Id
        $instId = session('instId');
        $start = ($pageNo - 1)*$pageSize;
        $class = new \Home\Model\ClassModel();
        $classList = $class->showClassList($instId,$start,$pageSize);
        $totals = $class->totalClasses($instId);
        $total = $totals[0]['total'];
        $this->assign('total',$total);
        $this->assign('pageNo',$pageNo);
        $this->assign('pageSize',$pageSize);
        $this->assign("howMangPages",ceil($total/$pageSize-1)+1);
        $this->assign('num',1);//记录编号
        $this->assign('classList',$classList);

        $student = new \Home\Model\StudentModel();
        $studentList = $student->showStudents($instId,0,500);
        for($i=0;$i<count($studentList);$i++){
            $captial = substr($studentList[$i]['pinyin'],0,1);
            $studentList[$i]['capital'] = $captial;
        }
        $this->assign("studentList",$studentList);
        $snum=0;
        $this->assign("snum",$snum);

        layout(true);
        $this->display();
    }

    public function showClassDetails($classId){
        //inst_Id
        $tId = session('instId');

        $class = new \Home\Model\ClassModel();
        $classInfo = $class->showClassById($classId,$tId);
        $classDetails = $class->showClassDetails($classId,$tId);
        $this->assign('classInfo',$classInfo);
        $this->assign('classDetails',$classDetails);//记录编号
        $pnum=0;
        $this->assign("pnum",$pnum);

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
        $studentList = $student->showStudents($tId,0,500);
        for($i=0;$i<count($studentList);$i++){
            $captial = substr($studentList[$i]['pinyin'],0,1);
            $studentList[$i]['capital'] = $captial;
        }
        $this->assign("studentList",$studentList);
        $snum=0;
        $this->assign("snum",$snum);

        layout(true);
        $this->display();
    }

    //apply context: when a class detail needs to be added
    public function addClassDetail($classId,$classroomId,$teacherId,$date,$startTime,$endTime){
        try{
            $tId = session('instId');
            $dayOfWeek = date('w',strtotime($date));//get the dayOfWeek of this timestamp
            if($dayOfWeek == 0)
                $dayOfWeek = 7;
            $ymd = explode('-',$date);
            $year = $ymd[0];
            $month = $ymd[1];
            $startTimeInt = str_replace(':','',$startTime);
            //save class detail
            $class = new \Home\Model\ClassModel();
            $classDetailId = $class->saveClassDetail($date,$year,$month,$dayOfWeek,$startTime,(int)$startTimeInt,$endTime,$teacherId,$classroomId,$classId,$tId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    //apply context: when one class detail needs to change classroom, a teacher, date, time.
    public function updateClassDetail($classId,$classDetailId,$classroomId,$teacherId,$date,$startTime,$endTime,$week){
        try{
            $tId = session('instId');
            $dayOfWeek = date('w',strtotime($date));//get the dayOfWeek of this timestamp
            if($dayOfWeek == 0)
                $dayOfWeek = 7;
            $ymd = explode('-',$date);
            $year = $ymd[0];
            $month = $ymd[1];
            $startTimeInt = str_replace(':','',$startTime);
            //save class detail
            $class = new \Home\Model\ClassModel();
            $result = $class->updateClassDetail($date,$year,$month,$dayOfWeek,$startTime,(int)$startTimeInt,$endTime,$teacherId,$classroomId,$classDetailId,$tId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    //apply context: when you want to delete one class detail.
    public function deleteClassDetail($classId,$classDetailId){
        try{
            $tId = session('instId');
            $class = new \Home\Model\ClassModel(); 
            $result = $class->deleteClassDetail($classId,$classDetailId,$tId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function saveStudentsForClass($classId,$students){
        try{
            $tId = session('instId');
            $class = new \Home\Model\ClassModel();
            $class->startTrans();
            $result = $class->showStudentsFromClass((int)$classId,$tId);
            for($i=0;$i<count($result);$i++){
                $oldStudentIds[] = $result[$i]['student_id'];
            }

            //students
            if($students==null || $students == ""){
                $newStudentIds = array();
            }else{
                $newStudentIds = explode('|',$students);
            }
            

            //find $deleteIds[] and $addIds[]
            if(!empty($oldStudentIds)){
                if(empty($newStudentIds)){
                    $deleteIds = $oldStudentIds;
                }else{
                    for($i=0;$i<count($oldStudentIds);$i++){
                        $shouldDelete = true;
                        for($j=0;$j<count($newStudentIds);$j++){
                            if((int)$oldStudentIds[$i] == (int)$newStudentIds[$j]){
                                $shouldDelete = false;
                            }
                        }
                        if($shouldDelete){
                            $deleteIds[] = $oldStudentIds[$i];
                        }
                    }
                }
            }

            if(!empty($newStudentIds)){
                if(empty($oldStudentIds)){
                    $addIds = $newStudentIds;
                }else{
                    for($i=0;$i<count($newStudentIds);$i++){
                        $shouldAdd = true;
                        for($j=0;$j<count($oldStudentIds);$j++){
                            if((int)$newStudentIds[$i] == (int)$oldStudentIds[$j]){
                                $shouldAdd = false;
                            }
                        }
                        if($shouldAdd){
                            $addIds[] = $newStudentIds[$i];
                        }
                    }
                }
            }
            
            $studentModel = new \Home\Model\StudentModel();
            $class = new \Home\Model\ClassModel();
            $classInfo = $class->getClassById((int)$classId,$tId);
            $tuition = $classInfo[0]['tuition_per_class'];

            $classDetails = $class->showClassDetailsById((int)$classId,$tId);

            $ndate = date("Y-m-d");
            //(int)(str_replace(':','',date('H:i')));
            $nstarttimeint = (int)date('Gi',time()+8*3600);
            for($i=0;$i<count($classDetails);$i++){
                $cdate = $classDetails[$i]['date'];
                $cstarttimeint = $classDetails[$i]['start_time_int'];
                if((($cdate == $ndate) && ($cstarttimeint>$nstarttimeint)) || ($cdate > $ndate)){
                    $leftClassDetails = array_slice($classDetails, $i);
                    break;
                }
            }

            $changedTuition = count($leftClassDetails)*$tuition;//发生改变的学费

            if(!empty($deleteIds)){
                for($i=0;$i<count($deleteIds);$i++){
                    
                    //logic delete
                    $class->updateStudentStatusFromClass($tId,(int)$classId,(int)$deleteIds[$i],1,-$changedTuition);

                    if(!empty($leftClassDetails) && count($leftClassDetails)>0){
                        for($m=0;$m<count($leftClassDetails);$m++){
                            //logic delete
                            $class->updateStudentStatusFromClassDetail($tId,(int)$classId,$leftClassDetails[$m]['class_detail_id'],(int)$deleteIds[$i],1);
                        }
                    }
                }
            }

            if(!empty($addIds)){
                for($i=0;$i<count($addIds);$i++){
                    //update student status
                    $studentModel->changeStudentStatus((int)$addIds[$i],$tId,2);

                    //try update first
                    $result = $class->updateStudentStatusFromClass($tId,(int)$classId,(int)$addIds[$i],0,$changedTuition);
                    if($result==0){
                        $class->saveClassAndStudentRela((int)$classId,(int)$addIds[$i],$tuition,0,$tId,$changedTuition,0);
                    }
                    if(!empty($leftClassDetails) && count($leftClassDetails)>0){
                        for($m=0;$m<count($leftClassDetails);$m++){
                            //先尝试删除此课程，以免重复添加
                            $class->updateStudentStatusFromClassDetail($tId,(int)$classId,$leftClassDetails[$m]['class_detail_id'],(int)$addIds[$i],1);
                            $class->saveClassDetailAndStudentRela($leftClassDetails[$m]['class_detail_id'],(int)$classId,(int)$addIds[$i],$tuition,$tId);
                        }
                    }
                }
            }
            $class->commit();
            $data = "true";
        }catch(Exception $e){
            $class->rollback();
            $data = "false";
        }
        $this->ajaxReturn($data);

    }

    public function saveStudentsToOneClass($classId,$classDetailId,$students){
        try{
            $tId = session('instId');
            $class = new \Home\Model\ClassModel();
            $class->startTrans();
            $result = $class->showStudentsFromClassDetail((int)$classDetailId,$tId);
            for($i=0;$i<count($result);$i++){
                $oldStudentIds[] = $result[$i]['student_id'];
            }

            //students
            if($students==null || $students == ""){
                $newStudentIds = array();
            }else{
                $newStudentIds = explode('|',$students);
            }
            
            //find $deleteIds[] and $addIds[]
            if(!empty($oldStudentIds)){
                if(empty($newStudentIds)){
                    $deleteIds = $oldStudentIds;
                }else{
                    for($i=0;$i<count($oldStudentIds);$i++){
                        $shouldDelete = true;
                        for($j=0;$j<count($newStudentIds);$j++){
                            if((int)$oldStudentIds[$i] == (int)$newStudentIds[$j]){
                                $shouldDelete = false;
                            }
                        }
                        if($shouldDelete){
                            $deleteIds[] = $oldStudentIds[$i];
                        }
                    }
                }
            }

            if(!empty($newStudentIds)){
                if(empty($oldStudentIds)){
                    $addIds = $newStudentIds;
                }else{
                    for($i=0;$i<count($newStudentIds);$i++){
                        $shouldAdd = true;
                        for($j=0;$j<count($oldStudentIds);$j++){
                            if((int)$newStudentIds[$i] == (int)$oldStudentIds[$j]){
                                $shouldAdd = false;
                            }
                        }
                        if($shouldAdd){
                            $addIds[] = $newStudentIds[$i];
                        }
                    }
                }
            }

            $class = new \Home\Model\ClassModel();
            $classInfo = $class->getClassById((int)$classId,$tId);
            $tuition = $classInfo[0]['tuition_per_class'];

            if(!empty($deleteIds)){
                for($i=0;$i<count($deleteIds);$i++){
                    $class->updateStudentStatusFromClassDetail($tId,(int)$classId,$classDetailId,(int)$deleteIds[$i],1);
                    $result = $class->selectStudentInfoFromClass($tId,(int)$classId,(int)$deleteIds[$i]);
                    $class->updateStudentStatusFromClass($tId,(int)$classId,(int)$deleteIds[$i],1,-$result[0]['tuition_per_class']);
                }
            }

            if(!empty($addIds)){
                for($i=0;$i<count($addIds);$i++){
                    //try update first
                    $result = $class->selectStudentInfoFromClass($tId,(int)$classId,(int)$addIds[$i]);
                    if($result == null || count($result)==0){
                        $class->saveClassAndStudentRela((int)$classId,(int)$addIds[$i],$tuition,1,$tId,$tuition,0);
                    }else{
                        $class->updateStudentStatusFromClass($tId,(int)$classId,(int)$addIds[$i],1,$result[0]['tuition_per_class']);
                        $tuition = $result[0]['tuition_per_class'];
                    }

                    $class->saveClassDetailAndStudentRela($classDetailId,(int)$classId,(int)$addIds[$i],$tuition,$tId);
                }
            }
            $class->commit();
            $data = "true";
        }catch(Exception $e){
            $class->rollback();
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    //add students to one classdetail
    //apply context: record not absent
    public function addStudentsIntoClassDetail($classId,$classDetailId,$studentIds){
        try{
            $tId = session('instId');
            //students
            $students = explode('|',$studentIds);
            $class = new \Home\Model\ClassModel();
            $class->startTrans();
            //save students that join this class
            for($i;$i<count($students);$i++){
                $class->saveClassDetailAndStudentRela($classDetailId,$classId,$students[$i],null,$tId);
            }
            $class->commit();
        }catch(Exception $e){
            $class->rollback();
        }
    }

    //del students from on classdetail
    //apply context: record  absent
    public function delStudentsFromClassDetail($classId,$classDetailId,$studentIds){
        try{
            $tId = session('instId');
            //students
            $students = explode('|',$studentIds);
            $class = new \Home\Model\ClassModel();
            $class->startTrans();
            //save students that join this class
            for($i;$i<count($students);$i++){
                $class->delClassDetailAndStudentRela($classDetailId,$students[$i],$tId);
            }
            $class->commit();
        }catch(Exception $e){
            $class->rollback();
        }
    }

    public function showStudentsFromClassDetail($classDetailId){
        //inst_Id
        $tId = session('instId');
        $class = new \Home\Model\ClassModel();
        $result = $class->showStudentsFromClassDetail((int)$classDetailId,$tId);
        $return = "";

        for($i=0;$i<count($result);$i++){
            $id = $result[$i]['id'];
            $studentName = $result[$i]['student_name'];
            $mobile = $result[$i]['mobile'];
            $isAbsent = $result[$i]['is_absent'];
            $studentId = $result[$i]['student_id'];
            $return .= $id.":".$studentName.":".$mobile.":".$isAbsent.":".$studentId.";";
        }

        $this->ajaxReturn($return);
    }

    //showStudentsFromClassDetailMobile
    public function editVacancy($classDetailId){
        if($classDetailId == null){
            return;
        }
        //inst_Id
        $tId = session('instId');
        $class = new \Home\Model\ClassModel();
        $students = $class->showStudentsFromClassDetail((int)$classDetailId,$tId);
        $classInfo = $class->showClassDetail((int)$classDetailId,$tId);
        $this->assign("stduents",$students);
        $this->assign("classInfo",$classInfo);
        layout(true);
        $this->display();
    }

    public function showStudentsFromClass($classId){
        //inst_Id
        $tId = session('instId');
        $class = new \Home\Model\ClassModel();
        $result = $class->showStudentsFromClass((int)$classId,$tId);
        $return = "";
        
        for($i=0;$i<count($result);$i++){
            $studentId = $result[$i]['student_id'];
            $studentName = $result[$i]['student_name'];
            $return .= $studentId.":".$studentName.";";
        }
        
        $this->ajaxReturn($return);
    }

    public function showAllStudentsFromClass($classId){
        //inst_Id
        $tId = session('instId');
        $class = new \Home\Model\ClassModel();
        $result = $class->showAllStudentsFromClass((int)$classId,$tId);
        $return = "";
        
        for($i=0;$i<count($result);$i++){
            $studentId = $result[$i]['student_id'];
            $studentName = $result[$i]['student_name'];
            $tuition = $result[$i]['tuition_per_class'];
            $return .= $studentId.":".$studentName.":".$tuition.";";
        }
        
        $this->ajaxReturn($return);
    }

    public function updateStudentTuitions($classId,$tuitions){
        try{
            $tId = session('instId');
            $sts = explode('|',$tuitions);
            $class = new \Home\Model\ClassModel();
            $class->startTrans();
            for($i=0;$i<count($sts);$i++){
                $st = explode(':',$sts[$i]);
                $class->updateStudentTuitionForClass($tId,(int)$classId,(int)$st[0],(int)$st[1]*100);
                $class->updateStudentTuitionForClassDetailAndStudentRela($tId,(int)$classId,(int)$st[0],(int)$st[1]*100);
            }
            $class->commit();
            $data = "true";
        }catch(Exception $e){
            $class->rollback();
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function updateClassDetailStudentRela($classId,$classDetailId,$cameRelaIds="",$notCameRelaIds=""){
        try{
            $tId = session('instId');
            $cameRelaIdsArr = array();
            if($cameRelaIds != "" && $cameRelaIds != null){
                $cameRelaIdsArr = explode('|',$cameRelaIds);
            }
            
            $notCameRelaIdsArr = array();
            if($notCameRelaIds != "" && $notCameRelaIds != null){
                $notCameRelaIdsArr = explode('|',$notCameRelaIds);
            }
            
            $class = new \Home\Model\ClassModel();
            $student = new \Home\Model\StudentModel();
            $class->startTrans();
            
            //get tuition deduct mode
            $deductFlag = $class->getClassDeductFlag($classId,$tId);
            $deductFlag = $deductFlag[0]['deduct_flag'];

            //get all students tuition_per_class
            $studentTuitions = $class->showAllStudentsFromClassDetail($classDetailId,$tId);
            for($i=0;$i<count($studentTuitions);$i++){
                $st = $studentTuitions[$i];
                $studentTuitionMap[$st['id']] = $st['tuition_per_class'];
            }

            $count = 0;
            if(count($cameRelaIdsArr) > 0){
                for($i=0;$i<count($cameRelaIdsArr);$i++){
                    $result = $class->updateClassDetailStudentRela($cameRelaIdsArr[$i],0,$tId);

                    $student->updateStudentBalance((int)$studentTuitionMap[$cameRelaIdsArr[$i]],$cameRelaIdsArr[$i],$tId);

                    if($result != 1){
                        $count++;
                    }
                }
            }

            if(count($notCameRelaIdsArr) > 0){
                for($i=0;$i<count($notCameRelaIdsArr);$i++){
                    $result = $class->updateClassDetailStudentRela($notCameRelaIdsArr[$i],1,$tId);
                    if($deductFlag == 1){
                        $student->updateStudentBalance((int)$studentTuitionMap[$notCameRelaIdsArr[$i]],$notCameRelaIdsArr[$i],$tId);
                    }
                    if($result != 1){
                        $count++;
                    }
                }
            }

            //update status
            $isAbsentCheck = 1;
            $class = new \Home\Model\ClassModel();
            $result = $class->updateClassDetailIsAbsentCheck($classDetailId,$tId,$isAbsentCheck);

            $class->commit();
            $data = "true";
        }catch(Exception $e){
            $class->rollback();
            $data = "false";
        }
        $this->ajaxReturn($data);
    }


    //showcase of the classes of a teacher or a classroom in a month
    public function showClasses($teacherId=0,$teacherName,$classroomId=0,$ym){
        if($teacherId==0){
            $teacherId = session('teacherId');
        }
        if($ym == null){
            $ym = date('Y-m');
        }

         //inst_id
        $tId = session('instId');
        
        $teacher = new \Home\Model\TeacherModel();
        $teacherList = $teacher->showTeachers($tId,0,50);
        if(session('isSuperAdmin') == 1){ 
            $this->assign("teacherList",$teacherList);
        }
        if($teacherName == null || $teacherName == ''){
            for($i=0;$i<count($teacherList);$i++){
                if($teacherList[$i]['teacher_id']==$teacherId){
                    $teacherName = $teacherList[$i]['name'];
                    break;
                }
            }
        }
        
        $classroom = new \Home\Model\ClassroomModel();
        $classroomList = $classroom->showClassrooms($tId,0,20);   
        $this->assign("classroomList",$classroomList);

        //年月list
        $ymList = array();
        $currym = date('Y-m');
        $lastmonth=date('Y-m',strtotime("$currym - 1 month"));
        array_push($ymList,$lastmonth);
        for($i=0;$i<6;$i++){
            $nextmonth=date('Y-m',strtotime("$currym + ".$i." month"));
            array_push($ymList,$nextmonth);
        }
        $this->assign("ymList",$ymList);

        if(($teacherId != 0 || $classroomId != 0) && $ym != null) {
            $class = new \Home\Model\ClassModel();
            $yearAndMonth = explode("-",$ym);
            $year = $yearAndMonth[0];
            $month = $yearAndMonth[1];
            $result;
            if($teacherId!=0){
                $result = $class->showClassesByTeacher($tId,$year,(int)$month,$teacherId);
            }
            else if($classroomId!=0){
                $result = $class->showClassesByClassroom($tId,$year,$month,$classroomId);
            }

            $nextmonth=date('Y-m-d',strtotime("$ym + 1 month"));
            $daysInMonth = date('d',strtotime($nextmonth)-24*3600);
            $lastDayInWeek = date('w',strtotime($nextmonth)-24*3600);
            $firstDayInWeek = date('w',strtotime($ym));
            if($firstDayInWeek == 0)
                $firstDayInWeek = 7;
            if($lastDayInWeek == 0)
                $lastDayInWeek = 7;

            //设定空集合
            $nullResult = array();
            for($n=0;$n<$daysInMonth;$n++){
                $nullDay = array();
                $nullDay['date'] = date('Y-m-d',strtotime("$ym + ".$n." day"));
                $nullDay['day_of_week'] = $firstDayInWeek;
                $nullDay['show_date'] = 1;

                $firstDayInWeek++;
                if($firstDayInWeek==8)
                    $firstDayInWeek = 1;
                $nullResult[$n]=$nullDay;
            }

            //填充有效数据
            $newResult = array();
            $hasToday = false;
            $showDate = true;
            for($n=0;$n<$daysInMonth;$n++){
                for($m=0;$m<count($result);$m++){
                    $date1 = $result[$m]['date'];
                    $ymd1 = explode('-',$date1);
                    $dayOfMonth1 = $ymd1[2];
                    if($dayOfMonth1 == $n+1){
                        if($showDate){
                            $result[$m]['show_date'] = 1;
                            $showDate = false;
                        }
                        array_push($newResult, $result[$m]);
                        $hasToday = true;
                    }
                }
                if(!$hasToday){
                    array_push($newResult, $nullResult[$n]);
                }
                $hasToday = false;
                $showDate = true;
            }

            $lastDayInWeek = date('w',strtotime($nextmonth)-24*3600);
            $firstDayInWeek = date('w',strtotime($ym));
            if($firstDayInWeek == 0)
                $firstDayInWeek = 7;
            if($lastDayInWeek == 0)
                $lastDayInWeek = 7;
            $isLeftPadding = false;
            $isRightPadding = false;
            //组装成表格的格式
            $monthly = array();
            $weeklyArray = array(array(),array(),array(),array(),array(),array());
            $dailyArray = array(array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array());
            $dc=-1;
            $wc=-1;
            $weekly;
            $currDay=100;
            $currDayOfWeek=100;
            $perClass = array();
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
                $showDate = $class['show_date'];
                $classId = $class['class_id'];
                $classDetailId = $class['class_detail_id'];
                $isAbsentCheck = $class['is_absent_check'];
                if($className != null){
                    $perClass = array("month"=>$month,"dayOfMonth"=>$dayOfMonth,"dayOfWeek"=>$dayOfWeek,"startTime"=>$startTime,"endTime"=>$endTime,"className"=>$className,"classroomName"=>$classroomName,"showDate"=>$showDate,"classDetailId"=>$classDetailId,"classId"=>$classId,"isAbsentCheck"=>$isAbsentCheck);
                }else{
                    $perClass = array("month"=>$month,"dayOfMonth"=>$dayOfMonth,"dayOfWeek"=>$dayOfWeek,"showDate"=>$showDate);
                }
                if($currDay != $dayOfMonth){//a new day
                    $dc++;
                    $currDay = $dayOfMonth;
                    $daily = &$dailyArray[$dc];
                    if($currDayOfWeek > $dayOfWeek){//a new week
                        $wc++;
                        $weekly = &$weeklyArray[$wc];
                        $monthly[$wc] = &$weeklyArray[$wc];//php区分值传递和引用传递！！
                    }
                    $currDayOfWeek = $dayOfWeek;
                    //补全上个月
                    if($dayOfMonth==1 && $dayOfWeek > 1 && $isLeftPadding == false){
                        for($n=1;$n<$firstDayInWeek;$n++){
                            array_push($weekly,array("dayOfWeek"=>$n));
                            $isLeftPadding = true;
                        }
                    }
                    $weeklyArray[$wc][] = &$dailyArray[$dc];
                    //array_push($weeklyArray[$wc], &$dailyArray[$dc]);
                }
                
                array_push($daily,$perClass);//添加月内数据
                 
                //补全下个月
                if($dayOfMonth == $daysInMonth && $dayOfWeek < 7 && $isRightPadding == false){
                    for($n=$lastDayInWeek+1;$n<=7;$n++){
                        array_push($weekly,array("dayOfWeek"=>$n));
                        $isRightPadding = true;
                    }
                }
            }
            $this->assign('monthlyClasses',$monthly);//记录编号
        }

        $this->assign('isSuperAdmin',session('isSuperAdmin'));
        $this->assign('teacherId',$teacherId);
        $this->assign('teacherName',$teacherName);
        $this->assign('ym',$ym);
        $this->assign('weekCounter',1);
        layout(true);
        $this->display();
    }

    //showcase of the classes of a teacher or a classroom in a DAY!!!
    public function showClassesDaily($teacherId=0,$teacherName,$ymd,$nextday){
        if($teacherId==0){
            $teacherId = session('teacherId');
        }
        if($ymd == null){
            $ymd = date('Y-m-d');
        }
        if($nextday != null && $nextday != ''){
            if($nextday == 'bw'){
                $ymd=date('Y-m-d',strtotime("$ymd - 1 day"));
            }
            if($nextday == 'fw'){
                $ymd=date('Y-m-d',strtotime("$ymd + 1 day"));
            }
        }
        $tId = session('instId');
        
        $teacher = new \Home\Model\TeacherModel();
        $teacherList = $teacher->showTeachers($tId,0,50);
        if(session('isSuperAdmin') == 1){    
            $this->assign("teacherList",$teacherList);
        }
        if($teacherName == null || $teacherName == ''){
            for($i=0;$i<count($teacherList);$i++){
                if($teacherList[$i]['teacher_id']==$teacherId){
                    $teacherName = $teacherList[$i]['name'];
                    break;
                }
            }
        }

        $class = new \Home\Model\ClassModel();
        $result = $class->showDailyClassesByTeacher($tId,$ymd,$teacherId);
        $this->assign("dailyClasses",$result);
        $this->assign('isSuperAdmin',session('isSuperAdmin'));
        $this->assign('teacherId',$teacherId);
        $this->assign('teacherName',$teacherName);
        $this->assign("ymd",$ymd);
        $this->assign('week',date('w',strtotime($ymd)));
        layout(true);
        $this->display();
    }

    public function getClassTuitionInfo($classId){
        if(empty($classId)){
            return;
        }
        $tId = session('instId');
        $class = new \Home\Model\ClassModel();
        $tuition = $class->getTuitionFromClass($classId,$tId);

        $today = date('Y-m-d');
        $startTimeInt = (int)date('Gi',time()+8*3600);
        $unfinishedClassTimes = $class->countUnfinishedClasses($today,$startTimeInt,$classId,$tId);

        $data = $tuition[0]['tuition_per_class']."&".$unfinishedClassTimes[0]['count'];
        $this->ajaxReturn($data);
    }



    //////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////CLASSTYPE///////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////

    public function addClassType(){
        layout(true);
        $this->display();
    }

    public function saveClassType($classtype){
        try{
            if($classtype == "")
                return;
            $instId = session('instId');
        
            $model = new \Home\Model\ClassModel();
            $result = $model->saveClasstype($classtype,$instId);
            $data = "true";
        }catch(Exception $e){
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
        $totals = $model->totalClasstypes($instId);
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
        try{
            $instId = session('instId');
            $model = new \Home\Model\ClassModel();
            $result = $model->deleteClassType($instId,$classTypeId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }


}