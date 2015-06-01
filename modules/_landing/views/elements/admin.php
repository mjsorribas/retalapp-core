<?php
/* @var $this ElementsController */
/* @var $model LandingElements */

$this->breadcrumbs=array(
	'Landing Elements'=>array('admin'),
	'Lista de Landing Elements',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
<?php echo CHtml::link('<i class="fa fa-plus"></i> '.Yii::t('app','Create'),array('create'),array('class'=>'btn btn-primary mbl'))?>
<?php foreach(LandingElementsPositions::model()->findAll() as $position):?>
<div class="panel panel-default">
  <div class="panel-heading"><?=$position->name?></div>
  <div class="panel-body">
    
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'landing-elements-grid',
	'itemsCssClass'=>'table table-inbox table-hover',
	'rowHtmlOptionsExpression'=>'array("id"=>$row."-".$data->id,"class"=>"cursor-move")',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'dataProvider'=>$model->search($position->id),
	'summaryCssClass'=>'text-right',
	'filter'=>$model,    'afterAjaxUpdate'=>"js:function(){
        $('#landing-elements-grid tbody').sortable({ opacity: 0.00001 });
        $('#landing-elements-grid tbody').sortable({
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
			'header'=>'preview',
			'name'=>'image',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'CHtml::image(Yii::app()->request->baseUrl."/uploads/".$data->image,"",array("class"=>"img-responsive img-thumbnail","style"=>"max-width:100px"))',
		),
		array(
			'filter'=>false,
			'name'=>'name',
			'type'=>'raw',
			'value'=>'$data->name',
		),
		array(
			'filter'=>false,
			'name'=>'module',
			'type'=>'raw',
			'value'=>'$data->module." - ".$data->type',
		),
		/*
		array(
			'class'=>'CLinkColumn',
			'label'=>Yii::t('app','View'),
			'htmlOptions'=>array('style'=>'width:60px'),
			'urlExpression'=>'Yii::app()->controller->createUrl("view",array("id"=>$data->primaryKey))',
			'linkHtmlOptions'=>array('class'=>'btn btn-success'),
		),
		*/
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

<?php endforeach;?>
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
	                    $.fn.yiiGridView.update('landing-elements-grid');
	                }
	            });
	        }
	    });
	});
    $("#landing-elements-grid tbody").sortable({ opacity: 0.00001 });
    $("#landing-elements-grid tbody").sortable({
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