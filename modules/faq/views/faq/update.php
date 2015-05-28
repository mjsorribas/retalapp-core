<?php
/* @var $this FaqController */
/* @var $model FaqFaq */

$this->breadcrumbs=array(
	'Preguntas frecuentes'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>