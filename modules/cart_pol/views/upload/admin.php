<?php
/* @var $this UploadController */
/* @var $model CartUpload */

$this->breadcrumbs=array(
	'Upload Codes'=>array('admin'),
	'Lista de Upload Codes',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
<div class="row">
	<div class="col-lg-6">
		<?php echo CHtml::link('<i class="fa fa-file"></i> '.Yii::t('app','Download CSV file'),array('csvToUpload'),array('class'=>'btn btn-success btn-lg btn-block'))?>	</div>
	<div class="col-lg-6">
		<?php echo CHtml::link('<i class="fa fa-upload"></i> '.Yii::t('app','Upload new CSV file'),array('create'),array('class'=>'btn btn-primary btn-lg btn-block'))?>		<h2 class="text-center mtl"><?=r('app','History of updates')?></h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cart-upload-grid',
	'itemsCssClass'=>'table table-inbox table-hover',
	'pager'=>array(
    	'class'=>'CLinkPager',
    	'htmlOptions'=>array(
    		'class'=>'pagination'
		),
		'header'=>false,
	),
    'pagerCssClass'=>'paginator-container',
	'dataProvider'=>$model->search(),
	'summaryCssClass'=>'text-center',
	'filter'=>$model,	'columns'=>array(
		/*
		array(
			'name'=>'id',
			'type'=>'raw',
			'value'=>'$data->id',
		),
		*/
		array(
			'name'=>'file',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'CHtml::link("<i class=\"fa fa-download\"></i>",$data->file_path,array("font-size:100%"))',
		),
		array(
			'filter'=>false,
			'name'=>'created_at',
			'type'=>'raw',
			'value'=>'$data->created_at." <small class=\"text-muted\">".r()->format->ago($data->created_at)."</small>"',
		),
		/*
		array(
			'name'=>'users_users_id',
			'filter'=>Users::listData(),
			'type'=>'raw',
			'value'=>'$data->user->name." ".$data->user->lastname',
		),
		array(
			'class'=>'CButtonColumn',
		),*/
		//array(
		//	'class'=>'CLinkColumn',
		//	'label'=>Yii::t('app','Delete'),
		//	'htmlOptions'=>array('style'=>'width:60px'),
		//	'urlExpression'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
		//	'linkHtmlOptions'=>array('class'=>'btn btn-danger','data-action'=>'delete'),
		//),
	),
)); ?>
	
	</div>
</div>


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
	                    $.fn.yiiGridView.update('cart-upload-grid');
	                },
	                error: function (xhr, ajaxOptions, thrownError) {
						bootbox.alert("Ocurrió un error <strong>BORRANDO</strong> el Registro, Verifique nuevamente");
					}
	            });
	        }
	    });
	});

});
</script>