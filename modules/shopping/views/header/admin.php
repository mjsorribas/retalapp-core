<?php
/* @var $this HeaderController */
/* @var $model ShoppingHeader */

$this->breadcrumbs=array(
	'Compras'=>array('admin'),
	'Lista de Compras',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
	   <?php #if(count($model->search()->getData())<12):?>
       <?php #echo CHtml::link('<i class="fa fa-plus"></i> '.Yii::t('app','Create'),array('create'),array('class'=>'mrs btn btn-primary'))?>
	   <?php #endif;?>
       <?php echo CHtml::link('<i class="fa fa-list"></i> '.Yii::t('app','Excel'),array('excel'),array('class'=>'mrs btn btn-success'))?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shopping-header-grid',
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
	'filter'=>$model,
		'columns'=>array(
		// array(
		// 	'name'=>'id',
		// 	'type'=>'raw',
		// 	'value'=>'$data->id',
		// ),
		array(
			'name'=>'ref_venta',
			'type'=>'raw',
			'value'=>'$data->ref_venta',
		),
		array(
			'name'=>'buyer_name',
			'type'=>'raw',
			'value'=>'$data->buyer_name." 
			<br> <span class=\"text-muted\"><i class=\"fa fa-envelope\"></i> {$data->buyer_email}</span> <span class=\"text-muted\"><i class=\"fa fa-mobile\"></i> {$data->buyer_phone}</span>"',
		),
		array(
			'name'=>'created_at',
			'type'=>'raw',
			'value'=>'$data->created_at',
		),
		array(
			'name'=>'state',
			'filter'=>ShoppingHeader::getStatesValues(),
			'type'=>'raw',
			'value'=>'$data->getStateLabel()',
		),
		array(
			'name'=>'message_return_pay',
			// 'filter'=>array('1'=>Yii::t("app","Enabled"),'0'=>Yii::t("app","Disabled")),
			'type'=>'raw',
			'value'=>'($data->message_return_pay==null)?"":$data->message_return_pay',
		),
		/*
		array(
			'name'=>'buyer_address',
			'type'=>'raw',
			'value'=>'$data->buyer_address',
		),
		array(
			'name'=>'buyer_message',
			'type'=>'raw',
			'value'=>'"<span class=\"text-muted\">".substr(strip_tags($data->buyer_message),0,50)."...</span>"',
		),
		array(
			'name'=>'send_name',
			'type'=>'raw',
			'value'=>'$data->send_name',
		),
		array(
			'name'=>'send_phone',
			'type'=>'raw',
			'value'=>'$data->send_phone',
		),
		array(
			'name'=>'send_address',
			'type'=>'raw',
			'value'=>'$data->send_address',
		),
		array(
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'send_date',
				'language' =>  Yii::app()->language,
				'htmlOptions' => array('class'=>'form-control'),
				'options' => array(
					'showButtonPanel' => true,
					'changeYear' => true,
					'dateFormat' => 'yy-mm-dd',
				),
			),true),
			'name'=>'send_date',
			'type'=>'raw',
			'value'=>'Yii::app()->format->formatShort($data->send_date)." <br><small class=\"text-muted\">".Yii::app()->format->formatAgoComment($data->send_date)."</small>"',
		),
		array(
			'name'=>'pol_response',
			'type'=>'raw',
			'value'=>'$data->pol_response',
		),
		*/
		/*array(
			'class'=>'CButtonColumn',
		),*/
		array(
			'class'=>'CLinkColumn',
			'label'=>Yii::t('app','Detalles de la compra'),
			'htmlOptions'=>array('style'=>'width:60px'),
			'urlExpression'=>'Yii::app()->controller->createUrl("view",array("id"=>$data->primaryKey))',
			'linkHtmlOptions'=>array('class'=>'btn btn-success'),
		),
		// array(
		// 	'class'=>'CLinkColumn',
		// 	'label'=>Yii::t('app','Update'),
		// 	'htmlOptions'=>array('style'=>'width:60px'),
		// 	'urlExpression'=>'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
		// 	'linkHtmlOptions'=>array('class'=>'btn btn-primary'),
		// ),
		// array(
		// 	'class'=>'CLinkColumn',
		// 	'label'=>Yii::t('app','Delete'),
		// 	'htmlOptions'=>array('style'=>'width:60px'),
		// 	'urlExpression'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
		// 	'linkHtmlOptions'=>array('class'=>'btn btn-danger','data-action'=>'delete'),
		// ),
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
	                    $.fn.yiiGridView.update('shopping-header-grid');
	                	// window.location.reload();
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