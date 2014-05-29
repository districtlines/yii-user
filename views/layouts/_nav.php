<?php

/* if(Yii::app()->user->checkAccess('User.Admin.Admin')) {
	// or superuser, but by definition if they are superuser they also have all privs, so it's cool.
	$users = User::model()->findAll(array('select' => 'id, username', 'order' => 'username'));
} */

$nav_items = array(
    'items' => array(
		array(
			'url' => array('/user/admin'),
			'label' => Yii::app()->getModule('user')->t("Manage Users"),
			'visible' => Yii::app()->user->checkAccess('User.Admin.Admin'),
            'labelIcon' => 'white-icons list',
		),
		array(
			'url' => array('/user/admin/create'),
			'label' => Yii::app()->getModule('user')->t("Create User"),
			'visible' => Yii::app()->user->checkAccess('User.Admin.Create'),
            'labelIcon' => 'white-icons user_add',
		),
		
	),
);
/*
foreach($users as $u){
	if(Yii::app()->user->checkAccess('User.Admin.View', array('id' => $u['id']))) {
		$label = ucfirst($u['username']);
		$info = array(
			'label' => "View {$label}",
			'url' => array("/user/admin/view", 'id'=>$u['id']),
            'labelIcon' => 'white-icons user',
		);
		array_push($nav_items['items'], $info);
	}
}
*/

$this->widget('ExtendedSideMenu', $nav_items);

?>