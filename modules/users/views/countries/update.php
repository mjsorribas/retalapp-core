<?php
/* @var $this CountriesController */
/* @var $model UsersLocationCountries */

$this->breadcrumbs=array(
	'Countries'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>
<div class="col-lg-12">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?></div>