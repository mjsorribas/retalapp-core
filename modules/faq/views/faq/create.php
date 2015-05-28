<?php
/* @var $this FaqController */
/* @var $model FaqFaq */

$this->breadcrumbs=array(
	'Preguntas frecuentes'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
