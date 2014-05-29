<?php
$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/login.css',"screen");

$this->pageTitle=UserModule::t("Change password"). ' | '.Yii::app()->name;
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change password"),
);
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile')),
    array('label'=>UserModule::t('Edit Profile'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal well'),
)); ?>
<p class="alert alert-info fade in">
	Fields with <span class="required">*</span> are required.
</p>
<?php echo $form->error($model,'oldPassword', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;')); ?>
<?php echo $form->error($model,'password', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;')); ?>
<?php echo $form->error($model,'verifyPassword', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;')); ?>
<div class="widget-block">
	<div class="widget-head">
		<h5><?php echo UserModule::t("Change password"); ?></h5>
	</div>
	<div class="widget-content">
		<div class="widget-box">
			<div class="well-registration">
				<div>
					<?php echo $form->errorSummary($model); ?>
	
					<div class="row-fluid" style="margin-top:10px;">
						<?php echo $form->labelEx($model,'oldPassword', array('class' => 'col-xs-12', 'style'=>'padding:0;')); ?>
						<?php echo $form->passwordField($model,'oldPassword', array('class' => 'col-xs-12')); ?>
					</div>
	
					<div class="row-fluid" style="margin-top:10px;">
						<?php echo $form->labelEx($model,'password', array('class' => 'col-xs-12', 'style'=>'padding:0;')); ?>
						<?php echo $form->passwordField($model,'password', array('class' => 'col-xs-12')); ?>
						<p class="hint"><?php echo UserModule::t("Minimal password length 6 symbols."); ?></p>
					</div>
	
					<div class="row-fluid" style="margin-top:10px;">
						<?php echo $form->labelEx($model,'verifyPassword', array('class' => 'col-xs-12', 'style'=>'padding:0;')); ?>
						<?php echo $form->passwordField($model,'verifyPassword', array('class' => 'col-xs-12')); ?>
					</div>
	
					<div class="row-fluid submit" style="margin-top:10px;">
						<?php echo CHtml::submitButton(UserModule::t("Save"), array('class'=>'btn btn-inverse login-btn', 'style'=>'width: 100%;')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>
