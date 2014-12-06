<?php
/* @var $this MessagesController */
/* @var $model JobMessages */

$this->breadcrumbs=array(
	'Job Messages'=>array('admin'),
	'Lista de Job Messages',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
    	<?php echo CHtml::link('<i class="fa fa-plus"></i> '.Yii::t('app','Create'),array('create'),array('class'=>'btn btn-primary'))?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-messages-grid',
	'itemsCssClass'=>'table table-inbox table-hover',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'dataProvider'=>$model->search(),
	'summaryCssClass'=>'text-right',
	'filter'=>$model,	'columns'=>array(
		array(
			'name'=>'id',
			'type'=>'raw',
			'value'=>'$data->id',
		),
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'$data->name',
		),
		array(
			'name'=>'phone',
			'type'=>'raw',
			'value'=>'$data->phone',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'$data->email',
		),
		/*
		array(
			'name'=>'message',
			'type'=>'raw',
			'value'=>'"<span class=\"text-muted\">".substr(strip_tags($data->message),0,50)."...</span>"',
		),
		array(
			'name'=>'file',
			'type'=>'raw',
			'value'=>'CHtml::link("<i class=\"fa fa-download\"></i>",Yii::app()->request->baseUrl."/uploads/".$data->file,array("font-size:100%"))',
		),
		array(
			'name'=>'read',
			'filter'=>array('1'=>Yii::t("app","Enabled"),'0'=>Yii::t("app","Disabled")),
			'type'=>'raw',
			'value'=>'($data->read)?"<span class=\"label label-success\">".Yii::t("app","Read")." ".Yii::t("app","Enabled")."</span>":"<span class=\"label label-danger\">".Yii::t("app","Read")." ".Yii::t("app","Disabled")."</span>"',
		),
		array(
			'name'=>'created_at',
			'type'=>'raw',
			'value'=>'$data->created_at',
		),
		*/
		/*array(
			'class'=>'CButtonColumn',
		),*/
		array(
			'class'=>'CLinkColumn',
			'label'=>Yii::t('app','View'),
			'htmlOptions'=>array('style'=>'width:60px'),
			'urlExpression'=>'Yii::app()->controller->createUrl("view",array("id"=>$data->primaryKey))',
			'linkHtmlOptions'=>array('class'=>'btn btn-success'),
		),
		array(
			'class'=>'CLinkColumn',
			'label'=>Yii::t('app','Update'),
			'htmlOptions'=>array('style'=>'width:60px'),
			'urlExpression'=>'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
			'linkHtmlOptions'=>array('class'=>'btn btn-primary'),
		),
		array(
			'class'=>'CLinkColumn',
			'label'=>Yii::t('app','Delete'),
			'htmlOptions'=>array('style'=>'width:60px'),
			'urlExpression'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
			'linkHtmlOptions'=>array('class'=>'btn btn-danger','data-action'=>'delete'),
		),
	),
)); ?>
		</div>
    </div>
</section>
</div>
<script>
$(function() {
	/**
	 * This event delete or publish an Item
	 * according to selected Item
	*/
	$(document).on('click','[data-action=delete]',function(e){
	    e.preventDefault();
	    var href = $(this).attr('href');
	    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro seleccionado?", function(result) {
	        if(result) {
	            $.ajax({
	                url: href,
	                success:function (data) {
	                    $.fn.yiiGridView.update('job-messages-grid');
	                }
	            });
	        }
	    });
	});

});
</script>