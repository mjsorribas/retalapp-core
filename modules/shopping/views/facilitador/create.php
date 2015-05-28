<?php
/* @var $this FacilitadorController */
/* @var $model ShoppingFacilitador */

$this->breadcrumbs=array(
	'Facilitadores'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
