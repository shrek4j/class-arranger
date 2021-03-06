<?php
namespace Home\Controller;
use Think\Controller;
class StudentController extends Controller {
    
    public function addStudent(){
        $instId = session('instId');
        $classtype = new \Home\Model\ClassModel();
        $classtypeList = $classtype->showClassTypes($instId,0,500);
        $this->assign("classtypeList",$classtypeList);

        $class = new \Home\Model\ClassModel();
        $classList = $class->showClassList($instId,0,100);
        $this->assign('classList',$classList);

        $tnum=0;
        $this->assign('tnum',$tnum);
        
        layout(true);
        $this->display();
    }

    //classoa_student:  interested_class int(10) classtype_id
    public function saveStudent($studentName="",$gender,$grade,$school,$remark,$mobile,$receivableTuition,$tuition,$tuitionPerClass,$interest,$attended){
        try{
            if($studentName == "")
                return;
            $pyUtil = new \Org\Util\Pinyin();
            $studPinyin = $pyUtil->getPinyin($studentName);
            $instId = session('instId');
        
            $studentModel = new \Home\Model\StudentModel();
            $classModel = new \Home\Model\ClassModel();
            $institutionModel = new \Home\Model\InstitutionModel();
            //logModel
            $instBalanceChangeLogModel = new \Home\Model\InstBalanceChangeLogModel();
            $studentBalanceChangeLogModel = new \Home\Model\StudentBalanceChangeLogModel();
            $studentModel->startTrans();

            //save student
            $studentIdArr = $studentModel->saveStudent($studentName,$studPinyin,$gender,$grade,$school,$remark,$mobile,$tuition*100,$instId,$interest);
            $studentId = (int)$studentIdArr[0]['student_id'];
            $reason = 1;//充值
            $studentBalanceChangeLogModel->savelog($studentId,$reason,0,$tuition*100);

            //save student attends class info (classId and tuitionPerClass and totalTuition)
            if(!empty($attended)){
                $classId = $attended;

                //finance transaction part1 start
                $actuallyPaid = $receivableTuition > $tuition ? $tuition : $receivableTuition;//实际能付的或需要付的对应此课程的学费
                $studentModel->addStudentBalance(-$actuallyPaid*100,$studentId,$instId);
                $reason = 3;//3:学费划转给机构
                $studentBalanceChangeLogModel->savelog($studentId,$reason,$classId,-$actuallyPaid*100);
                //finance transaction part1 end

                $classDetails = $classModel->showClassDetailsById((int)$classId,$instId);
                $ndate = date("Y-m-d");
                $nstarttimeint = (int)date('Gi',time()+8*3600);
                for($i=0;$i<count($classDetails);$i++){
                    $cdate = $classDetails[$i]['date'];
                    $cstarttimeint = $classDetails[$i]['start_time_int'];
                    if((($cdate == $ndate) && ($cstarttimeint>$nstarttimeint)) || ($cdate > $ndate)){
                        $leftClassDetails = array_slice($classDetails, $i);
                        break;
                    }
                }

                //update student status
                $studentModel->changeStudentStatus($studentId,$instId,2);
                //save student fee info
                $classModel->saveClassAndStudentRela((int)$classId,$studentId,$tuitionPerClass*100,0,$instId,$receivableTuition*100,$actuallyPaid*100);
                if(!empty($leftClassDetails) && count($leftClassDetails)>0){
                    for($m=0;$m<count($leftClassDetails);$m++){
                        //add student and classDetail rela
                        $classModel->saveClassDetailAndStudentRela($leftClassDetails[$m]['class_detail_id'],(int)$classId,$studentId,$tuitionPerClass*100,$instId);
                    }
                }

                //finance transaction part2 start
                //change inst balance
                $institutionModel->updateInstitutionBalance($actuallyPaid*100,$instId);
                $reason = 1;//1：学费转入
                $instBalanceChangeLogModel->saveLog($instId,$reason,$studentId,$actuallyPaid*100);
                //finance transaction part2 end
            }
            $data = "true";
            $studentModel->commit();
        }catch(Exception $e){
            $data = "false";
            $studentModel->rollback();
        }
        $this->ajaxReturn($data);
    }

    public function attendNewClass($studentId,$receivableTuition,$tuition,$tuitionPerClass,$attended){
        try{
            $instId = session('instId');
            $classId = $attended;

            $studentModel = new \Home\Model\StudentModel();
            $classModel = new \Home\Model\ClassModel();
            $institutionModel = new \Home\Model\InstitutionModel();
            //logModel
            $instBalanceChangeLogModel = new \Home\Model\InstBalanceChangeLogModel();
            $studentBalanceChangeLogModel = new \Home\Model\StudentBalanceChangeLogModel();

            $studentModel->startTrans();
            //add tuition to student total tuition
            $studentModel->addStudentBalance($tuition*100,$studentId,$instId);
            $reason = 1;//充值
            $studentBalanceChangeLogModel->savelog($studentId,$reason,0,$tuition*100);
            
            //finance transaction part1 start
            $balance = $studentModel->showStudentBalance($instId,$studentId);
            $actuallyPaid = $receivableTuition > $balance[0]['balance'] ? $balance : $receivableTuition;//实际能付的或需要付的对应此课程的学费
            $studentModel->addStudentBalance(-$actuallyPaid*100,$studentId,$instId);

            $reason = 3;//3:学费划转给机构
            $studentBalanceChangeLogModel->savelog($studentId,$reason,$classId,-$actuallyPaid*100);
            //finance transaction part1 end

            //save student attends class info (classId and tuitionPerClass and totalTuition)
            $classDetails = $classModel->showClassDetailsById((int)$classId,$instId);
            $ndate = date("Y-m-d");
            $nstarttimeint = (int)date('Gi',time()+8*3600);
            for($i=0;$i<count($classDetails);$i++){
                $cdate = $classDetails[$i]['date'];
                $cstarttimeint = $classDetails[$i]['start_time_int'];
                if((($cdate == $ndate) && ($cstarttimeint>$nstarttimeint)) || ($cdate > $ndate)){
                    $leftClassDetails = array_slice($classDetails, $i);
                    break;
                }
            }

            //update student status
            $studentModel->changeStudentStatus($studentId,$instId,2);
            //save student fee info
            $classModel->saveClassAndStudentRela((int)$classId,$studentId,$tuitionPerClass*100,0,$instId,$receivableTuition*100,$actuallyPaid*100);
            if(!empty($leftClassDetails) && count($leftClassDetails)>0){
                for($m=0;$m<count($leftClassDetails);$m++){
                    //add student and classDetail rela
                    $classModel->saveClassDetailAndStudentRela($leftClassDetails[$m]['class_detail_id'],(int)$classId,$studentId,$tuitionPerClass*100,$instId);
                }
            }

            //finance transaction part2 start
            //change inst balance
            $institutionModel->updateInstitutionBalance($actuallyPaid*100,$instId);
            $reason = 1;//1：学费转入
            $instBalanceChangeLogModel->saveLog($instId,$reason,$studentId,$actuallyPaid*100);
            //finance transaction part2 end

            $data = "true";
            $studentModel->commit();
        }catch(Exception $e){
            $data = "false";
            $studentModel->rollback();
        }
        $this->ajaxReturn($data);
    }

    public function showAttendNewClass($studentId){
        $instId = session('instId');
        $studentModel = new \Home\Model\StudentModel();
        $student = $studentModel->showStudentDetail($instId,$studentId);
        $this->assign('student',$student[0]);

        $classModel = new \Home\Model\ClassModel();
        $classList = $classModel->showClassList($instId,0,100);
        $this->assign('classList',$classList);

        $tnum=0;
        $this->assign('tnum',$tnum);
        
        layout(true);
        $this->display();
    }

    public function updateStudent($studentName="",$gender,$grade,$school,$remark,$mobile,$balance,$studentId){
        try{
            if($studentName == "")
                return;
            $pyUtil = new \Org\Util\Pinyin();
            $studPinyin = $pyUtil->getPinyin($studentName);
            $instId = session('instId');
        
            $model = new \Home\Model\StudentModel();
            $result = $model->updateStudent($studentName,$studPinyin,$gender,$grade,$school,$remark,$mobile,$balance*100,$studentId,$instId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showStudents($pageNo=1,$pageSize=10){
        $instId = session('instId');
        if(!$instId)
            return;
        $start = ($pageNo - 1)*$pageSize;
        $model = new \Home\Model\StudentModel();
        $studentList = $model->showStudents($instId,$start,$pageSize);
        $totals = $model->total($instId);
        $total = $totals[0]['total'];
        $this->assign('studentList',$studentList);
        $this->assign('total',$total);
        $this->assign('pageNo',$pageNo);
        $this->assign('pageSize',$pageSize);
        $this->assign("howMangPages",ceil($total/$pageSize-1)+1);
        $this->assign('num',1);//记录编号
        layout(true);
        $this->display();
    }

    public function showAttendedClasses($studentId){
        $instId = session('instId');
        if(!$instId)
            return;
        $classModel = new \Home\Model\ClassModel();
        $classList = $classModel->showClassesByStudent($studentId,$instId);
        $this->assign('classList',$classList);
        $this->assign('num',1);//记录编号
        layout(true);
        $this->display();
    }

    public function showStudentDetail($studentId){
        $instId = session('instId');
        if(!$instId)
            return;
        $model = new \Home\Model\StudentModel();
        $student = $model->showStudentDetail($instId,$studentId);
        $this->assign('student',$student[0]);
        layout(true);
        $this->display();
    }

    public function deleteStudent($studentId){
        $instId = session('instId');
        
        try{
            $model = new \Home\Model\StudentModel();
            $result = $model->deleteStudent($instId,$studentId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function chargeRemainingTuition($id,$studentId,$classId,$chargeTuition){
        $instId = session('instId');
        try{
            $classModel = new \Home\Model\ClassModel();
            $institutionModel = new \Home\Model\InstitutionModel();
            //logModel
            $instBalanceChangeLogModel = new \Home\Model\InstBalanceChangeLogModel();
            $studentBalanceChangeLogModel = new \Home\Model\StudentBalanceChangeLogModel();

            $classModel->startTrans();

            //finance transaction part1 start
            $reason = 1;//充值
            $studentBalanceChangeLogModel->savelog($studentId,$reason,0,$chargeTuition*100);
            $reason = 4;//学费补缴给机构
            $studentBalanceChangeLogModel->savelog($studentId,$reason,$classId,-$chargeTuition*100);
            $classModel->updateStudentTuitionById($chargeTuition*100,(int)$id,$instId);
            //finance transaction part1 end

            //finance transaction part2 start
            //change inst balance
            $institutionModel->updateInstitutionBalance($chargeTuition*100,$instId);
            $reason = 2;//学费补缴
            $instBalanceChangeLogModel->saveLog($instId,$reason,$studentId,$chargeTuition*100);
            //finance transaction part2 end

            $data = "true";
            $classModel->commit();
        }catch(Exception $e){
            $data = "false";
            $classModel->rollback();
        }
        $this->ajaxReturn($data);
    }

    public function refundTuition($id,$studentId,$classId,$refundTuition){
        $instId = session('instId');
        try{
            $classModel = new \Home\Model\ClassModel();
            $studentModel = new \Home\Model\StudentModel();
            $institutionModel = new \Home\Model\InstitutionModel();
            //logModel
            $instBalanceChangeLogModel = new \Home\Model\InstBalanceChangeLogModel();
            $studentBalanceChangeLogModel = new \Home\Model\StudentBalanceChangeLogModel();

            $classModel->startTrans();

            //finance transaction part1 start
            $studentModel->addStudentBalance($refundTuition*100,$studentId,$instId);
            $reason = 5;//学费返还给学生
            $studentBalanceChangeLogModel->savelog($studentId,$reason,$classId,$refundTuition*100);
            $classModel->updateStudentTuitionById(-$refundTuition*100,(int)$id,$instId);
            //finance transaction part1 end

            //finance transaction part2 start
            //change inst balance
            $institutionModel->updateInstitutionBalance(-$refundTuition*100,$instId);
            $reason = 3;//退还学费给学生
            $instBalanceChangeLogModel->saveLog($instId,$reason,$studentId,-$refundTuition*100);
            //finance transaction part2 end

            $data = "true";
            $classModel->commit();
        }catch(Exception $e){
            $data = "false";
            $classModel->rollback();
        }
        $this->ajaxReturn($data);
    }

}