<?php
/* @var $this AuthorController */
/* @var $model BlogAuthor */

$this->breadcrumbs=array(
	'Author'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
