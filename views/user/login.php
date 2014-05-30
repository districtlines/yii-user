<?php
$cs = Yii::app()->getClientScript();
Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/login.css',"screen");

$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
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

<div class="login-container" style="width:280px;">
	<?php echo CHtml::beginForm('/user/login', 'post'); ?>
		<div class="well-login">
			<div class="control-group">
				<div class="controls">
					<div>
						<?php echo CHtml::activeTextField($model,'username', array('class'=> 'login-input user-name', 'placeholder'=>'Username')); ?>
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<div>
						<?php echo CHtml::activePasswordField($model,'password', array('class'=> 'login-input user-pass', 'placeholder'=>'Password')); ?>
					</div>
				</div>
			</div>
			<div class="clearfix">
				<?php echo CHtml::submitButton(UserModule::t("Login"), array('class'=>'btn btn-inverse login-btn')); ?>
			</div>
			<div class="hint">
				<p><?php if(0 && !isset($hideRegisterLink)){ echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php } ?><?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?></p>
			</div>
			<div class="remember-me">
				<div class="left">
					<?php echo CHtml::activeCheckBox($model,'rememberMe', array('style'=> 'margin: 0 0 2px;')); ?> Remember Me
				</div>
				<div class="right">
					<?php // echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
				</div>
				<div class="clear clearfix"></div>
			</div>
		</div>
	<?php echo CHtml::endForm(); ?>
	<?php $this->widget('application.extensions.hoauth.widgets.HOAuth'); ?>
</div>