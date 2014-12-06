<?php
/* @var $this HowworkController */
/* @var $model HowWorkItems */

$this->breadcrumbs=array(
	'How does it work? Steps'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>