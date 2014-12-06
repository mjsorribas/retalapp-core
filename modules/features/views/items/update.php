<?php
/* @var $this ItemsController */
/* @var $model FeaturesItems */

$this->breadcrumbs=array(
	'Features'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>