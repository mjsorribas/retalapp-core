<?php
/* @var $this FeaturesController */
/* @var $model ShoppingFeatures */

$this->breadcrumbs=array(
	'Beneficios'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>