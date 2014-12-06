<?php
/* @var $this PostsController */
/* @var $model BlogPosts */

$this->breadcrumbs=array(
	'Posts'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
