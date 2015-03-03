<?php
/* @var $this PushmessageController */
/* @var $model PushMessage */

$this->breadcrumbs=array(
	'Messajes'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
