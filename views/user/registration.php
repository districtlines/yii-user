<?php
$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/login.css',"screen");

$this->pageTitle=UserModule::t("Registration"). ' | '.Yii::app()->name;
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>
<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="alert alert-info">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="registration-container form" style="width: 440px;">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'errorMessageCssClass' => 'test',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal'),
)); ?>
	<?php echo $form->error($model,'username', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;' )); ?>
	<?php echo $form->error($model,'password', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;')); ?>
	<?php echo $form->error($model,'verifyPassword', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;' )); ?>
	<?php echo $form->error($model,'email', array('class' => 'alert alert-error', 'style' => 'padding: 5px; margin-bottom: 5px;')); ?>
	<div class="well-registration">
		<div>
			<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
			
			<?php echo $form->errorSummary(array($model,$profile)); ?>
			
			<div class="row-fluid">
				<?php echo $form->labelEx($model,'username', array('class' => 'col-xs-12', 'style'=>'padding:0;')); ?>
				<?php echo $form->textField($model,'username', array('class' => 'col-xs-12')); ?>
				<?php // echo $form->error($model,'username', array('class' => 'col-xs-12')); ?>
			</div>
			
			<div class="row-fluid" style="margin-top:10px;">
				<div class="col-xs-6" style="padding-left:0;">
					<?php echo $form->labelEx($model,'password', array('class' => 'col-xs-12', 'style'=>'padding:0;')); ?>
					<?php echo $form->passwordField($model,'password', array('class' => 'col-xs-12')); ?>
					<?php // echo $form->error($model,'password', array('class' => 'col-xs-12')); ?>
				</div>
				<div class="col-xs-6" style="padding-right:0;">
					<?php echo $form->labelEx($model,'verifyPassword', array('class' => 'col-xs-12', 'style'=>'padding:0;')); ?>
					<?php echo $form->passwordField($model,'verifyPassword', array('class' => 'col-xs-12')); ?>
					<?php // echo $form->error($model,'verifyPassword', array('class' => 'col-xs-12')); ?>
				</div>
			</div>
			<div class="row-fluid" style="margin-top:5px;">
				<div class="col-xs-12" style="padding:0px;">
					<p class="hint"><?php echo UserModule::t("Minimal password length 6 symbols."); ?></p>
				</div>
			</div>
			<div class="row-fluid" style="margin-top:10px;">
				<?php echo $form->labelEx($model,'email', array('class' => 'col-xs-12', 'style'=>'padding:0;')); ?>
				<?php echo $form->textField($model,'email', array('class' => 'col-xs-12')); ?>
				<?php // echo $form->error($model,'email', array('class' => 'col-xs-12')); ?>
			</div>
			
		<?php 
			$profileFields=Profile::getFields();
			if ($profileFields) {
					foreach($profileFields as $field) {
					?>
			<div class="row-fluid">
				<?php echo $form->labelEx($profile,$field->varname); ?>
				<?php 
				if ($widgetEdit = $field->widgetEdit($profile)) {
					echo $widgetEdit;
				} elseif ($field->range) {
					echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
				} elseif ($field->field_type=="TEXT") {
					echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
				} else {
					echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
				}
				 ?>
				<?php echo $form->error($profile,$field->varname); ?>
			</div>	
					<?php
					}
				}
				?>
			<?php if (UserModule::doCaptcha('registration')): ?>
			<div class="row-fluid" style="margin-top:10px;">
				<?php echo $form->labelEx($model,'verifyCode', array('class' => 'col-xs-12', 'style'=>'padding:0;')); ?>
				
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