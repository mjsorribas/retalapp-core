<?php
/* @var $this UploadController */
/* @var $model CartUpload */

$this->breadcrumbs=array(
	'Upload Codes'=>array('admin'),
	Yii::t('app','View'),
);
 ?><div class="col-lg-12">
	<div class="alert alert-success">
		<em><strong><?=r('app','Congratulation!!! ;)')?></strong> <?=r('app','All your contacts are right')?></em>
	</div>
	<div class="col-lg-4"></div>
	<div class="col-lg-4">
		<a href="<?=$this->createUrl("create")?>" class="btn btn-primary btn-lg btn-block"><?=r('app','Upload other')?></a>
		<a href="<?=$this->createUrl("admin")?>" class="btn btn-default btn-lg btn-block"><?=r('app','View all uploads')?></a>
	</div>
	<div class="col-lg-4"></div>
</div>

