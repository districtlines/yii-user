<?php

class UserRegistrationWidget extends CWidget {

	public function run(){
		$model = new RegistrationForm;
		$profile=new Profile;

		$this->render('application.modules.user.views.user._modal_registration',array('model'=>$model,'profile'=>$profile));
	}
}