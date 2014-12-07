<?php
/* @var $this StatesController */
/* @var $model CartStates */

$this->breadcrumbs=array(
	'Cart States'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
