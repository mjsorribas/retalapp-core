<?php
/* @var $this PostsController */
/* @var $model BlogPosts */

$this->breadcrumbs=array(
	'Posts'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>