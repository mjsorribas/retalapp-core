<?php
/* @var $this ItemsController */
/* @var $model CustomersItems */

$this->breadcrumbs=array(
	'Customers'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
