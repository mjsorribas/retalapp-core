<?php
/* @var $this StatesController */
/* @var $model UsersLocationStates */

$this->breadcrumbs=array(
	'States'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
