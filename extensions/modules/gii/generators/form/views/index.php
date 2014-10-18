
<div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
<?php $form=$this->beginWidget('CCodeForm', array('model'=>$model)); ?>
<div class="row">
	<div class="col-lg-4">
	
	<div class="form-group">
		<?php 
		$modules=array();
		foreach(Yii::app()->getModules() as $id=>$params)
		{
			$core='';
			if(in_array($id, $this->module->noModules))
				$core='[CORE] ';
			if($params and strpos($params['class'], 'ext.')!==false)
				$modules[$id]=$core.$id;
			else
				$modules[$id]=$core.$id;
		}
		$htmlOptions=array( 
			'ajax' => array(
				'type'=>'POST', //request type
				'url'=>$this->createUrl('modelsDynamic'), //url to call.
				'update'=>'#'.get_class($model).'_model', //selector to update
			),
			'empty'=>'',
			'class'=>'form-control'
		);?>
		<?php echo $form->labelEx($model,'moduleName', array('class' => 'control-label')); ?>
		<?php echo $form->dropDownList($model,'moduleName',$modules,$htmlOptions); ?>
		<?php echo $form->error($model,'moduleName'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'model'); ?>
		<?php echo $form->dropDownList($model,'model',$this->module->getListDataModels($model->moduleName,$this->codeModel),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'model'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'viewName'); ?>
		<?php echo $form->textField($model,'viewName', array('size'=>65,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'viewName'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
    </div>
</section>
</div>