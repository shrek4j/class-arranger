<?php
namespace Home\Controller;
use Think\Controller;
class MorphController extends Controller {

    public function showMorphemesByCapital($capital='a'){
        $morph = new \Home\Model\MorphModel();
        $morphList = $morph->showMorphemeByCapital($capital);
        $this->assign('morphList',$morphList);
        layout(true);
        $this->display();
    }

    public function showWordsByMorpheme($morphemeId=1){
        $morph = new \Home\Model\MorphModel();
        $wordList = $morph->showWordsByMorpheme($morphemeId);
        $this->assign('wordList',$wordList);
        $this->assign('num',1);//记录编号
		$morpheme = $morph->showMorphemeById($morphemeId);
        $this->assign('morpheme',$morpheme);
        layout(true);
        $this->display();
    }
	
}