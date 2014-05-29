<?php

class UserLoginWidget extends CWidget {

	public function run(){
		$model = new UserLogin;

		$this->render('application.modules.user.views.user._modal_login',array('model'=>$model, 'hideRegisterLink' => true));
	}
}