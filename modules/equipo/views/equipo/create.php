<?php
/* @var $this EquipoController */
/* @var $model EquipoEquipo */

$this->breadcrumbs=array(
	'Nuestro equipo'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>
