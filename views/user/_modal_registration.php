<?php
$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/login.css',"screen");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/placeholders.min.js');

?>
<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="alert alert-info">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="registration-container form row">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'action' => '/user/registration',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'clientOptions'=>array(
		'errorCssClass' => 'has-error',
		'successCssClass' => 'has-success',
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal col-xs-12', 'style'=>'padding:15px;'),
)); ?>
	<?php echo $form->error($model,'username', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;' )); ?>
	<?php echo $form->error($model,'password', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;')); ?>
	<?php echo $form->error($model,'verifyPassword', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;' )); ?>
	<?php echo $form->error($model,'email', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;')); ?>
	<div class="well-registration">
		<div>
			<?php echo $form->errorSummary(array($model,$profile)); ?>
			
			<div class="row-fluid">
				<?php echo $form->textField($model,'username', array('class' => 'form-control col-xs-12', 'placeholder'=>'Username')); ?>
			</div>
			<div class="row-fluid" style="margin-top:10px;">
				<?php echo $form->passwordField($model,'password', array('class' => 'form-control col-xs-12', 'placeholder'=>'Password')); ?>
			</div>
			<div class="row-fluid" style="margin-top:10px;">
				<?php echo $form->passwordField($model,'verifyPassword', array('class' => 'form-control col-xs-12', 'placeholder'=>'Verify Password')); ?>
			</div>
<!--
			<div class="row-fluid" style="margin-top:5px;">
				<div class="col-xs-12" style="padding:0px;">
					<p class="hint"><?php echo UserModule::t("Minimal password length 6 symbols."); ?></p>
				</div>
			</div>
-->
			<div class="row-fluid" style="margin-top:10px;">
				<?php echo $form->textField($model,'email', array('class' => 'form-control col-xs-12', 'placeholder'=>'Email')); ?>
			</div>
			<?php if (UserModule::doCaptcha('registration')): ?>
			<div class="row-fluid" style="margin-top:10px;">
				<?php echo $form->labelEx($model,'verifyCode', array('class' => 'form-control col-xs-12', 'style'=>'padding:0;')); ?>
				
				<?php $this->widget('CCaptcha'); ?>
				<?php echo $form->textField($model,'verifyCode', array('class' => 'col-xs-12')); ?>
				<?php echo $form->error($model,'verifyCode', array('class' => 'col-xs-12')); ?>
				
				<p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
				<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
			</div>
			<?php endif; ?>
			
			<div class="row-fluid submit" style="margin-top:10px;">
				<?php echo CHtml::submitButton(UserModule::t("Register"), array('class'=>'btn btn-inverse login-btn', 'style'=>'width: 100%;')); ?>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>