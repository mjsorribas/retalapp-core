<?php
/* @var $this CategoriesController */
/* @var $model ShoppingCategories */

$this->breadcrumbs=array(
	'Categorías'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
