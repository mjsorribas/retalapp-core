<?php
/* @var $this CategoriesController */
/* @var $model PortfolioCategories */

$this->breadcrumbs=array(
	'Categories'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
