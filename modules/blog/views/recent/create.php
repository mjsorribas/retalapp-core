<?php
/* @var $this RecentController */
/* @var $model HomeRecentPost */

$this->breadcrumbs=array(
	'Recent Post'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
