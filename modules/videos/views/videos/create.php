<?php
/* @var $this VideosController */
/* @var $model VideosVideos */

$this->breadcrumbs=array(
	'Vídeos'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
