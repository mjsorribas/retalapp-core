<?php
/* @var $this ItemsController */
/* @var $model ShoppingItems */

$this->breadcrumbs=array(
	'Productos'=>array('admin'),
	'Lista de Productos',
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
	'id'=>'shopping-items-grid',
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
        $('#shopping-items-grid tbody').sortable({ opacity: 0.00001 });
        $('#shopping-items-grid tbody').sortable({
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
			'value'=>'CHtml::image($data->image_path,"",array("class"=>"img-responsive img-thumbnail","style"=>"max-width:100px"))',
		),
		array(
			'name'=>'video_promocional',
			'type'=>'raw',
			'value'=>'CHtml::link("<i class=\"fa fa-external-link\"></i> ".strtr($data->video_promocional,array("http://"=>"","https://"=>"")),$data->video_promocional,array("target"=>"_blank"))',
		),
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'$data->name',
		),
		/*
		array(
			'name'=>'slug',
			'type'=>'raw',
			'value'=>'$data->slug',
		),
		array(
			'name'=>'description',
			'type'=>'raw',
			'value'=>'"<span class=\"text-muted\">".substr(strip_tags($data->description),0,50)."...</span>"',
		),
		array(
			'name'=>'description_detail',
			'type'=>'raw',
			'value'=>'$data->description_detail',
		),
		array(
			'name'=>'price',
			'type'=>'raw',
			'value'=>'$data->price',
		),
		array(
			'name'=>'state',
			'filter'=>array('1'=>Yii::t("app","Enabled"),'0'=>Yii::t("app","Disabled")),
			'type'=>'raw',
			'value'=>'($data->state)?"<span class=\"label label-success\">".Yii::t("app","State")." ".Yii::t("app","Enabled")."</span>":"<span class=\"label label-danger\">".Yii::t("app","State")." ".Yii::t("app","Disabled")."</span>"',
		),
		array(
			'name'=>'shopping_categories_id',
			'filter'=> ShoppingCategories::listData(),
			'type'=>'raw',
			'value'=>'$data->shopping_categories_id',
			//'value'=>'$data->relationame->namefieldtoshow',
		),
		array(
			'name'=>'temas_relacionados',
			'type'=>'raw',
			'value'=>'"<span class=\"text-muted\">".substr(strip_tags($data->temas_relacionados),0,50)."...</span>"',
		),
		array(
			'name'=>'shopping_facilitador_id',
			'filter'=> ShoppingFacilitador::listData(),
			'type'=>'raw',
			'value'=>'$data->shopping_facilitador_id',
			//'value'=>'$data->relationame->namefieldtoshow',
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
			'label'=>Yii::t('app','Videos/ Material/ Actualizaciones'),
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
	                    $.fn.yiiGridView.update('shopping-items-grid');
	                	// window.location.reload();
	                },
	                error: function (xhr, ajaxOptions, thrownError) {
						bootbox.alert("Ocurrió un error <strong>BORRANDO</strong> el Registro, Verifique nuevamente");
					}
	            });
	        }
	    });
	});
    $("#shopping-items-grid tbody").sortable({ opacity: 0.00001 });
    $("#shopping-items-grid tbody").sortable({
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