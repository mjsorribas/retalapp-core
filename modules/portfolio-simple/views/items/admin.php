<?php
/* @var $this ItemsController */
/* @var $model PortfolioItems */

$this->breadcrumbs=array(
	'Our Work'=>array('admin'),
	'Lista de Our Work',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
    	<?php echo CHtml::link('<i class="fa fa-plus"></i> '.Yii::t('app','Create'),array('create'),array('class'=>'btn btn-primary'))?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'portfolio-items-grid',
	'itemsCssClass'=>'table table-inbox table-hover',
	'rowHtmlOptionsExpression'=>'array("id"=>$row."-".$data->id,"class"=>"cursor-move")',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'dataProvider'=>$model->search(),
	'summaryCssClass'=>'text-right',
	'filter'=>$model,    'afterAjaxUpdate'=>"js:function(){
        $('#portfolio-items-grid tbody').sortable({ opacity: 0.00001 });
        $('#portfolio-items-grid tbody').sortable({
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
		array(
			'name'=>'id',
			'type'=>'raw',
			'value'=>'$data->id',
		),
		array(
			'name'=>'image',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'"<span class=\"text-muted\">".substr($data->image,0,50)."...</span>"',
			'value'=>'CHtml::image(Yii::app()->request->baseUrl."/uploads/".$data->image,"",array("class"=>"img-responsive img-thumbnail","style"=>"max-width:100px"))',
		),
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'$data->name',
		),
		array(
			'name'=>'description',
			'type'=>'raw',
			'value'=>'"<span class=\"text-muted\">".substr(strip_tags($data->description),0,50)."...</span>"',
		),
		/*
		array(
			'name'=>'link',
			'type'=>'raw',
			'value'=>'CHtml::link("<i class=\"fa fa-external-link\"></i> ".strtr($data->link,array("http://"=>"","https://"=>"")),$data->link,array("target"=>"_blank"))',
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
	                    $.fn.yiiGridView.update('portfolio-items-grid');
	                },
	                error: function (xhr, ajaxOptions, thrownError) {
						bootbox.alert("Ocurrió un error <strong>BORRANDO</strong> el Registro, Verifique nuevamente");
					}
	            });
	        }
	    });
	});
    $("#portfolio-items-grid tbody").sortable({ opacity: 0.00001 });
    $("#portfolio-items-grid tbody").sortable({
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