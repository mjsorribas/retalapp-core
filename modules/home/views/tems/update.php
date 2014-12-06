<?php
/* @var $this TemsController */
/* @var $model HomeItems */

$this->breadcrumbs=array(
	'Home Items'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>