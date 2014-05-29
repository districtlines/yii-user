<?php
$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/login.css',"screen");
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/placeholders.min.js');

$errorSummary = CHtml::errorSummary($model);
if(isset($errorSummary) && !empty($errorSummary)){ ?>
<div class="alert alert-error fade in">
	<?php echo $errorSummary; ?>
</div>
<?php } ?>
<?php if(Yii::app()->user->hasFlash('loginMessage')){ ?>
<div class="alert alert-info">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>
<?php } ?>

<div class="login-container row">
	<?php echo CHtml::beginForm('/user/login', 'post', array('class'=>'col-xs-12','style'=>'padding:15px;')); ?>
		<div class="well-login">
			<div class="row-fluid">
				<?php echo CHtml::activeTextField($model,'username', array('class'=> 'user-name col-xs-12', 'placeholder'=>'Username')); ?>
			</div>
			<div class="row-fluid" style="margin-top:10px;">
				<?php echo CHtml::activePasswordField($model,'password', array('class'=> 'user-pass col-xs-12', 'placeholder'=>'Password')); ?>
			</div>
			<div class="hint">
				<p><?php echo CHtml::activeCheckBox($model,'rememberMe', array('style'=> 'margin: 0 0 2px;')); ?> Remember Me | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?></p>
			</div>
<!--
			<div class="remember-me row">
				<div class="col-xs-6">
					
				</div>
				<div class="col-xs-6">
					<?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
				</div>
			</div>
-->
			<div class="row-fluid" style="margin-top:10px;">
				<?php echo CHtml::submitButton(UserModule::t("Login"), array('class'=>'btn btn-inverse', 'style' => 'width: 100%;')); ?>
			</div>
		</div>
	<?php echo CHtml::endForm(); ?>
	<?php $this->widget('application.extensions.hoauth.widgets.HOAuth'); ?>
</div>