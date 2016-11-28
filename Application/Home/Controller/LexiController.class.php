<?php
namespace Home\Controller;
use Think\Controller;
class LexiController extends Controller {

    //-------------------------word--------------------------------
    public function addWord(){
        $lexi = new \Home\Model\LexiModel();
        $wordRootList = $lexi->showWordroots();
        for($i=0;$i<count($wordRootList);$i++){
            $captial = substr($wordRootList[$i]['word_root'],0,1);
            $wordRootList[$i]['capital'] = $captial;
        }
        $this->assign('wordRootList',$wordRootList);
        $this->assign('cnum',1);//记录编号
        layout(true);
        $this->display();
    }

    public function saveWord($classroom,$rent){
        if($classroom == "")
            return;
        $instId = session('instId');

        try{
            $model = new \Home\Model\ClassroomModel();
            $result = $model->saveClassroom($classroom,(int)$rent*100,$instId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showWords($pageNo=1,$pageSize=10){
        $instId = session('instId');
        if(!$instId)
            return;
        $start = ($pageNo - 1)*$pageSize;
        $model = new \Home\Model\ClassroomModel();
        $classroomList = $model->showClassrooms($instId,$start,$pageSize);
        $totals = $model->total($instId);
        $total = $totals[0]['total'];
        $this->assign('classroomList',$classroomList);
        $this->assign('total',$total);
        $this->assign('pageNo',$pageNo);
        $this->assign('pageSize',$pageSize);
        $this->assign("howMangPages",ceil($total/$pageSize-1)+1);
        $this->assign('num',1);//记录编号
        layout(true);
        $this->display();
    }

    public function deleteWord($classroomId){
        $instId = session('instId');
        try{
            $model = new \Home\Model\ClassroomModel();
            $result = $model->deleteClassroom($instId,$classroomId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }


    //-------------------------word root--------------------------------
    public function addWordRoot(){
        $lexi = new \Home\Model\LexiModel();
        $categoryList = $lexi->showCategories();
        $this->assign('categoryList',$categoryList);
        $this->assign('cnum',1);//记录编号
        layout(true);
        $this->display();
    }

    public function saveWordRoot($wordroot,$meaning,$origin,$category){
        try{
            $model = new \Home\Model\LexiModel();
            $result = $model->saveWordRoot($wordroot,$meaning,$origin,$category);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }

    public function showWordRoots($pageNo=1,$pageSize=10){
        $instId = session('instId');
        if(!$instId)
            return;
        $start = ($pageNo - 1)*$pageSize;
        $model = new \Home\Model\ClassroomModel();
        $classroomList = $model->showClassrooms($instId,$start,$pageSize);
        $totals = $model->total($instId);
        $total = $totals[0]['total'];
        $this->assign('classroomList',$classroomList);
        $this->assign('total',$total);
        $this->assign('pageNo',$pageNo);
        $this->assign('pageSize',$pageSize);
        $this->assign("howMangPages",ceil($total/$pageSize-1)+1);
        $this->assign('num',1);//记录编号
        layout(true);
        $this->display();
    }

    public function deleteWordRoot($classroomId){
        $instId = session('instId');
        try{
            $model = new \Home\Model\ClassroomModel();
            $result = $model->deleteClassroom($instId,$classroomId);
            $data = "true";
        }catch(Exception $e){
            $data = "false";
        }
        $this->ajaxReturn($data);
    }
}