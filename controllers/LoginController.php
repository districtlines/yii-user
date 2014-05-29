<?php

class LoginController extends GxController
{
	public $defaultAction = 'login';
	public $layout='//layouts/column1';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', 
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('oauthadmin'),
				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
				'actions'=>array('oauthadmin'),
				'users'=>array('*'),
			),
		);
	}
	
	public function actions(){
		return array(
			'oauth' => array(
				'class'=>'application.extensions.hoauth.HOAuthAction',
			),
			'oauthadmin' => array(
				'class'=>'application.extensions.hoauth.HOAuthAdminAction',
			),
		);
	}
	
	public function redirect($url,$terminate=true,$statusCode=302){
		if(is_array($url)){
			$route=isset($url[0]) ? $url[0] : '';
			$url=$this->createUrl($route,array_splice($url,1));
		}
		Yii::app()->session->close();

		Yii::app()->getRequest()->redirect($url,$terminate,$statusCode);
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					
					
					if (Yii::app()->getBaseUrl(true)."/" === Yii::app()->request->urlReferrer)
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(Yii::app()->request->urlReferrer);
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit_at = date('Y-m-d H:i:s');
		$lastVisit->save();
	}

}