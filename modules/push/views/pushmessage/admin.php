<?php
/* @var $this PushmessageController */
/* @var $model PushMessage */

$this->breadcrumbs=array(
	'Messajes'=>array('admin'),
	'Lista de Messajes',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
       <?php echo CHtml::link('<i class="fa fa-plus"></i> '.Yii::t('app','Create'),array('create'),array('class'=>'mrs btn btn-primary'))?>
       <?php #echo CHtml::link('<i class="fa fa-list"></i> '.Yii::t('app','Excel'),array('excel'),array('class'=>'mrs btn btn-success'))?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'push-message-grid',
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
			'type'=>'raw',
			'value'=>'$data->id',
		),
		array(
			'name'=>'mobile_id_from',
			'type'=>'raw',
			'value'=>'$data->mobile_id_from',
		),
		array(
			'name'=>'mobile_id_to',
			'type'=>'raw',
			'value'=>'$data->mobile_id_to',
		),
		array(
			'name'=>'message',
			'type'=>'raw',
			'value'=>'"<span class=\"text-muted\">".substr(strip_tags($data->message),0,50)."...</span>"',
		),
		/*
		array(
			'name'=>'img_imagen',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'"<span class=\"text-muted\">".substr($data->img_imagen,0,50)."...</span>"',
			'value'=>'CHtml::image($data->img_imagen_path,"",array("class"=>"img-responsive img-thumbnail","style"=>"max-width:100px"))',
		),
		array(
			'name'=>'date_created',
			'type'=>'raw',
			'value'=>'$data->date_created',
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
	                    $.fn.yiiGridView.update('push-message-grid');
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