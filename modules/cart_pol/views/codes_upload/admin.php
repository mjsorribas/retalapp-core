<?php
/* @var $this Codes_uploadController */
/* @var $model CartUpload */

$this->breadcrumbs=array(
	'Secrets Codes'=>array('admin'),
	'Lista de Secrets Codes',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
       <?php #echo CHtml::link('<i class="fa fa-plus"></i> '.Yii::t('app','Create'),array('create'),array('class'=>'mrs btn btn-primary'))?>
       <?php #echo CHtml::link('<i class="fa fa-list"></i> '.Yii::t('app','Excel'),array('excel'),array('class'=>'mrs btn btn-success'))?>
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
		array(
			'name'=>'id',
			'htmlOptions'=>array('style'=>'width:50px'),
			'type'=>'raw',
			'value'=>'$data->id',
		),
		array(
			'filter'=>false,
			'htmlOptions'=>array('style'=>'width:50px'),
			'name'=>'file',
			'type'=>'raw',
			'value'=>'CHtml::link("<i class=\"fa fa-download\"></i>",$data->file_path,array("font-size:100%"))',
		),
		array(
			'name'=>'created_at',
			'type'=>'raw',
			'value'=>'"{$data->created_at} <br> <small class=\"text-muted\">".r()->format->ago($data->created_at)."</small>"',
		),
		array(
			'name'=>'users_users_id',
			//'filter'=>Users::listData(),
			'filter'=>false,
			'type'=>'raw',
			'value'=>'$data->user->name." ".$data->user->lastname',
		),
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
		/*
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
		*/
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