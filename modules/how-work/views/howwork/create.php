<?php
/* @var $this HowworkController */
/* @var $model HowWorkItems */

$this->breadcrumbs=array(
	'How does it work? Steps'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
