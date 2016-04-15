<?php
namespace Home\Behaviors;
class NavBehavior extends \Think\Behavior{
    //行为执行入口
    public function run(&$return){
        session('pnav',$_REQUEST['pnav']);
        session('nav',$_REQUEST['nav']);
        $return = true;
    }
}