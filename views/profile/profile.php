<?php $this->pageTitle=UserModule::t("Profile").' |  '.Yii::app()->name;
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Dashboard"),
);
$this->menu=array(
	array(
		'label'=>UserModule::t('Manage Users'),
		'url'=>array('/user/admin'),
		'visible' => Yii::app()->user->checkAccess('User.Admin.Admin'),
	),
	array('label'=>UserModule::t('Edit Account Info'), 'url'=>array('edit')),
	array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
	array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);

$this->widget('application.extensions.fancybox.EFancyBox', array(
	'target'=>'.orders',
	'config'=>array(
		'maxWidth'	=> 800,
		'maxHeight'	=> 600,
		'fitToView'	=> false,
		'width'		=> '70%',
		'height'	=> '70%',
		'autoSize'	=> false,
	),
));

//$this->beginClip('sidebar');
?>
<?php // $this->endClip(); ?>
<section class="row-fluid">
	<section class="col-xs-12" style="padding: 0px 5px;">
		<div class="nonboxy-widget faq">
			<div class="widget-head">
				<h5>Hello, <?= $model->profile->first_name ?> <?= $model->profile->last_name ?>!</h5>
			</div>
			<div class="widget-content">
				<p>From your Account Dashboard you have the ability to view and update your account information.</p>
<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
			</div>
		</div>
	</section>
</section>
<section class="row-fluid">
	<section class="col-xs-12 col-md-6" style="padding: 0px 5px;">
		<div class="nonboxy-widget">
			<div class="widget-head">
				<h5>Account Info<small class="profileManage pull-right"><?php echo CHtml::link('Manage',array('/user/profile/edit')); ?></small></h5>
			</div>
			<div class="widget-content">
				<table class="form-horizontal table well">
					<tr>
						<th style="width:150px"><?php echo ucfirst(CHtml::encode($model->getAttributeLabel('username'))); ?></th>
					    <td><?php echo CHtml::encode($model->username); ?></td>
					</tr>
					<?php 
						$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
						if ($profileFields) {
							foreach($profileFields as $field) { ?>
					<tr>
						<th><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
						<td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
					</tr>
							<?php
							}
						}
					?>
					<tr>
						<th><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
				    	<td><?php echo CHtml::encode($model->email); ?></td>
					</tr>
					<tr>
						<th><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
						<td><?php echo Yii::app()->format->datetime($model->create_at); ?></td>
					</tr>
					<tr>
						<th><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
						<td><?php echo Yii::app()->format->datetime($model->lastvisit); ?></td>
					</tr>
<!--
					<tr>
						<th><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
						<td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></td>
					</tr>
-->
				</table>
<?php  $this->widget('application.extensions.hoauthCustomWidgets.EHOAuth', array('user' => $model)) ?>
			</div>
		</div>
	</section>
	<section class="col-xs-12 col-md-6" style="padding: 0px 5px;">
		<div class="nonboxy-widget">
			<div class="widget-head">
				<h5>Stores you are associated with:</h5>
			</div>
			<div class="widget-content">
				<table class="form-horizontal table well">
					<thead>
						<tr>
							<th style="text-align:left;">Store Name</th>
							<th style="text-align:left;">Admin</th>
							<th style="text-align:left;">Create Products</th>
							<th style="text-align:left;">View Statistics</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($model->VendorGenreAssociation as $vg){ ?>
						<tr>
							<td><?= $vg->genre->name ?></td>
							<td class="alert <?= $vg->is_admin ? 'alert-success' : '' ?>"><?= $vg->is_admin ? 'True' : 'False' ?></td>
							<td class="alert <?= $vg->is_admin || $vg->create_products ? 'alert-success' : '' ?>"><?= $vg->is_admin || $vg->create_products ? 'True' : 'False' ?></td>
							<td class="alert <?= $vg->is_admin || $vg->view_statistics ? 'alert-success' : '' ?>"><?= $vg->is_admin || $vg->view_statistics ? 'True' : 'False' ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</section>

<?php // $this->widget('application.extensions.hoauth.widgets.HOAuthProfile', array('user' => $model)) ?>
<?php // $this->widget('application.extensions.hoauth.widgets.HConnectedNetworks') ?>
