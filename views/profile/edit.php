<?php
$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/login.css',"screen");

$this->pageTitle=UserModule::t("Profile"). ' | '.Yii::app()->name;
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);
?>
<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal well'),
)); ?>
	<p class="alert alert-info fade in">
		Fields with <span class="required">*</span> are required.
	</p>
<?php echo $form->error($model,'username', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;' )); ?>

<div class="widget-block">
	<div class="widget-head">
		<h5><?php echo UserModule::t('Edit profile'); ?></h5>
	</div>
	<div class="widget-content">
		<div class="widget-box">
			<div class="well-registration">
				<div>
					<?php echo $form->errorSummary(array($model,$profile)); ?>
				
					<div class="row-fluid">
						<?php echo $form->labelEx($model,'username', array('class' => 'col-xs-12', 'style'=>'padding:0;')); ?>
						<?php echo $form->textField($model,'username', array('class' => 'col-xs-12')); ?>
						<?php echo $form->error($model,'username', array('class' => 'col-xs-12')); ?>
					</div>
					
				<?php 
						$profileFields=Profile::getFields();
						if ($profileFields) {
							foreach($profileFields as $field) {
							?>
					<div class="row-fluid" style="margin-top:10px;">
						<?php echo $form->labelEx($profile,$field->varname, array('class' => 'col-xs-12', 'style'=>'padding:0;'));
						
						if ($widgetEdit = $field->widgetEdit($profile)) {
							echo $widgetEdit;
						} elseif ($field->range) {
							echo $form->dropDownList($profile,$field->varname,Profile::range($field->range), array('class' => 'col-xs-12',));
						} elseif ($field->field_type=="TEXT") {
							echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50, 'class' => 'col-xs-12'));
						} else {
							echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class' => 'col-xs-12'));
						}
						echo $form->error($profile,$field->varname); ?>
					</div>	
							<?php
							}
						}
				?>
				
					<div class="row-fluid submit" style="margin-top:10px;">
						<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'), array('class'=>'btn btn-inverse login-btn', 'style'=>'width: 100%;')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>
