<?php
/* @var $this ClientsController */
/* @var $model ClientsItems */

$this->breadcrumbs=array(
	'Our Clients'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
