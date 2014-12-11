<?php
/* @var $this UsersController */
/* @var $model UsersUsers */

$this->breadcrumbs=array(
	'Users'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
