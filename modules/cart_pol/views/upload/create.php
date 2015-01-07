<?php
/* @var $this UploadController */
/* @var $model CartUpload */

$this->breadcrumbs=array(
	'Upload Codes'=>array('admin'),
	Yii::t('app','Create'),
);
 ?><div class="col-lg-12">
	<?php if($errors!==array()):?>
	<div class="alert alert-danger">
		<em><strong><?=r('app','Data validation errors')?></strong> <?=r('app','Please review the following information and try again')?></em>
	</div>

	<table class="table table-bordered">
		<?php foreach($errors as $ID => $data):?>		<tr>
			<td>ID <strong><?=$ID?></strong></td>
			<td>
				<?php foreach($data as $label => $row):?>
					<strong><?=$modelToUpload->getAttributeLabel($label)?>:</strong> <br>
					<?php foreach($row as $error):?>
					<span><?=$error?>
</span><br>
					<?php endforeach;?>
				<?php endforeach;?>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
	<?php endif;?>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
