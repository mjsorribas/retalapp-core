<?php
/* @var $this PurchasesController */
/* @var $model CartShoppingHeader */

$this->breadcrumbs=array(
	'Purchases'=>array('admin'),
	'Lista de Purchases',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
    	<?php #echo CHtml::link('<i class="fa fa-plus"></i> '.Yii::t('app','Create'),array('create'),array('class'=>'btn btn-primary'))?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cart-shopping-header-grid',
	'itemsCssClass'=>'table table-inbox table-hover',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'dataProvider'=>$model->search(),
	'summaryCssClass'=>'text-right',
	'filter'=>$model,	'columns'=>array(
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
			'name'=>'users_id',
			'filter'=>CHtml::listData(Users::model()->findAll(array('condition'=>'1=1')),'id','fullName'),
			'type'=>'raw',
			'value'=>'$data->user->name." ".$data->user->lastname',
		),
		array(
			'name'=>'total',
			'type'=>'raw',
			'visible'=>!$this->module->justRequest,
			'value'=>'$data->getTotalShipping()',
		),
		// array(
		// 	'name'=>'shipping_cost',
		// 	'type'=>'raw',
		// 	'value'=>'$data->shipping_cost',
		// ),
		array(
			'name'=>'cart_states_id',
			'filter'=>$this->module->justRequest?false:CHtml::listData(CartStates::model()->findAll(array('condition'=>'1=1')),'id','description'),
			'type'=>'raw',
			'value'=>'"<span class=\"label label-{$data->state->class_status}\"> <i class=\"fa {$data->state->icon_class}\"></i> {$data->state->description}</span>"',
		),
		array(
			// 'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			// 	'model' => $model,
			// 	'attribute' => 'created_at',
			// 	'language' =>  Yii::app()->language,
			// 	'htmlOptions' => array('class'=>'form-control'),
			// 	'options' => array(
			// 		'showButtonPanel' => true,
			// 		'changeYear' => true,
			// 		'dateFormat' => 'yy-mm-dd',
			// 	),
			// ),true),
			'header'=>Yii::t('app','Date of shop'),
			'name'=>'created_at',
			'type'=>'raw',
			'value'=>'Yii::app()->format->formatShort($data->created_at)." <br><small class=\"text-muted\">".Yii::app()->format->formatAgoComment($data->created_at)."</small>"',
		),
		/*
		array(
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'updated_at',
				'language' =>  Yii::app()->language,
				'htmlOptions' => array('class'=>'form-control'),
				'options' => array(
					'showButtonPanel' => true,
					'changeYear' => true,
					'dateFormat' => 'yy-mm-dd',
				),
			),true),
			'name'=>'updated_at',
			'type'=>'raw',
			'value'=>'Yii::app()->format->formatShort($data->updated_at)." <br><small class=\"text-muted\">".Yii::app()->format->formatAgoComment($data->updated_at)."</small>"',
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
		// array(
		// 	'class'=>'CLinkColumn',
		// 	'label'=>Yii::t('app','Update'),
		// 	'htmlOptions'=>array('style'=>'width:60px'),
		// 	'urlExpression'=>'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
		// 	'linkHtmlOptions'=>array('class'=>'btn btn-primary'),
		// ),
		array(
			'class'=>'CLinkColumn',
			'label'=>Yii::t('app','Delete'),
			'htmlOptions'=>array('style'=>'width:60px'),
			'visible'=>isset($_GET['d']),
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
	                    $.fn.yiiGridView.update('cart-shopping-header-grid');
	                }
	            });
	        }
	    });
	});

});
</script>