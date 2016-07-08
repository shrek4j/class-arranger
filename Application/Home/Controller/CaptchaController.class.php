<?php
namespace Home\Controller;
use Think\Controller;

require_once dirname(dirname(__FILE__)) . '/Common/Captcha/lib/Geetestlib.class.php';
require_once dirname(dirname(__FILE__)) . '/Common/Captcha/config/config.php';

class CaptchaController extends Controller {
	const CAPTCHA_ID = "4974184e02b5cf4ecac72d47dce511eb";
	const PRIVATE_KEY = "999af9d402eefaae9e9e9694d43c8609";

	public function startCaptcha(){
		$GtSdk = new \Home\Common\GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
		$user_id = "306757880@qq.com";
		$status = $GtSdk->pre_process($user_id);
		session('gtserver',$status);
		session('user_id',$user_id);
		$rsp = $GtSdk->get_response_str();
		$this->ajaxReturn($rsp);
	}

	public function verifyCaptcha($geetest_challenge,$geetest_validate,$geetest_seccode){
		$GtSdk = new \Home\Common\GeetestLib(CAPTCHA_ID, PRIVATE_KEY);
		$user_id = session('user_id');
		$rsp = "Yes!";
		if (session('gtserver') == 1) {
		    $result = $GtSdk->success_validate($geetest_challenge, $geetest_validate, $geetest_seccode, $user_id);
		    if ($result) {
		    	session('can_doLogin',true);
		        $rsp = 'Yes!';
		    } else{
		        $rsp = 'No';
		    }
		}else{
		    if ($GtSdk->fail_validate($geetest_challenge,$geetest_validate,$geetest_seccode)) {
		        $rsp = "yes";
		    }else{
		        $rsp = "no";
		    }
		}
		$this->ajaxReturn($rsp);
	}

}