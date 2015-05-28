<?php
/* @var $this TestimoniosController */
/* @var $model TestimoniosTestimonios */

$this->breadcrumbs=array(
	'Testimonios'=>array('admin'),
	'Lista de Testimonios',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
	   <?php #if(count($model->search()->getData())<12):?>
       <?php echo CHtml::link('<i class="fa fa-plus"></i> '.Yii::t('app','Create'),array('create'),array('class'=>'mrs btn btn-primary'))?>
	   <?php #endif;?>
       <?php #echo CHtml::link('<i class="fa fa-list"></i> '.Yii::t('app','Excel'),array('excel'),array('class'=>'mrs btn btn-success'))?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'testimonios-testimonios-grid',
	'itemsCssClass'=>'table table-inbox table-hover',
	'rowHtmlOptionsExpression'=>'array("id"=>$row."-".$data->id,"class"=>"cursor-move")',
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
	'filter'=>$model,
	    'afterAjaxUpdate'=>"js:function(){
        $('#testimonios-testimonios-grid tbody').sortable({ opacity: 0.00001 });
        $('#testimonios-testimonios-grid tbody').sortable({
            update: function() {
                var that = $(this);
                $('.loading').html('<i class=\"fa fa-refresh fa-spin\"></i>');
                setTimeout(function () {
                    var order = that.sortable('toArray');
                    $.post('".$this->createUrl("order")."', {order: order}, function(datos){
                        $('.loading').empty();
                    });
                },2000);
            }
        });
    }",
	'columns'=>array(
		// array(
		// 	'name'=>'id',
		// 	'type'=>'raw',
		// 	'value'=>'$data->id',
		// ),
		array(
			'name'=>'imagen',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'"<span class=\"text-muted\">".substr($data->imagen,0,50)."...</span>"',
			'value'=>'CHtml::image($data->imagen_path,"",array("class"=>"img-responsive img-thumbnail","style"=>"max-width:100px"))',
		),
		array(
			'name'=>'testimonio',
			'type'=>'raw',
			'value'=>'"<span class=\"text-muted\">".substr(strip_tags($data->testimonio),0,50)."...</span>"',
		),
		array(
			'name'=>'nombre_usuario',
			'type'=>'raw',
			'value'=>'$data->nombre_usuario',
		),
		/*
		array(
			'name'=>'ocupacion_usuario',
			'type'=>'raw',
			'value'=>'$data->ocupacion_usuario',
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
	                    $.fn.yiiGridView.update('testimonios-testimonios-grid');
	                	// window.location.reload();
	                },
	                error: function (xhr, ajaxOptions, thrownError) {
						bootbox.alert("Ocurrió un error <strong>BORRANDO</strong> el Registro, Verifique nuevamente");
					}
	            });
	        }
	    });
	});
    $("#testimonios-testimonios-grid tbody").sortable({ opacity: 0.00001 });
    $("#testimonios-testimonios-grid tbody").sortable({
    	update: function() {
    		var that = $(this);
			$('.loading').html('<i class="fa fa-refresh fa-spin"></i>');
    		setTimeout(function () {
	        	var order = that.sortable("toArray");
		        $.post('<?php echo $this->createUrl("order") ?>', {order: order}, function(datos){
	    			$('.loading').empty();
		        });
    		},2000);
        }
    });

});
</script>