<?php
/* @var $this ItemsController */
/* @var $model CustomersItems */

$this->breadcrumbs=array(
	'Customers'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>