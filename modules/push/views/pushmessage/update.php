<?php
/* @var $this PushmessageController */
/* @var $model PushMessage */

$this->breadcrumbs=array(
	'Messajes'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>