<?php
/* @var $this TestimoniosController */
/* @var $model TestimoniosTestimonios */

$this->breadcrumbs=array(
	'Testimonios'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
