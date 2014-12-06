<?php
/* @var $this NewsController */
/* @var $model ContactNews */

$this->breadcrumbs=array(
	'Contact Newsletter'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
