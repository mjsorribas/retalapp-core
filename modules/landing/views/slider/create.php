<?php
/* @var $this SliderController */
/* @var $model LandingElementsSlider */

$this->breadcrumbs=array(
	'Slider'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
