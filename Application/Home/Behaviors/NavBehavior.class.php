<?php
namespace Home\Behaviors;
class NavBehavior extends \Think\Behavior{
    //行为执行入口
    public function run(&$return){
    	if($_REQUEST['pnav'] != null && $_REQUEST['pnav'] != "" && $_REQUEST['nav'] != null && $_REQUEST['nav'] != ""){
    		session('pnav',$_REQUEST['pnav']);
	        session('nav',$_REQUEST['nav']);
    	}
        $return = true;
    }
}