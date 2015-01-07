<?php
/* @var $this CodesController */
/* @var $model CartSecretCodes */

$this->breadcrumbs=array(
	'Secrets Codes'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
