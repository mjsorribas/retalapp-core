<?php
/* @var $this MessagesController */
/* @var $model ContactMessages */

$this->breadcrumbs=array(
	'Messages'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
