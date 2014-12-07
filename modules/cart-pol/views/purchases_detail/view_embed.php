<?php
/* @var $this Purchases_detailController */
/* @var $model CartShoppingDetail */


/*
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$purchases_detail=new CartShoppingDetail;
$criteria=new CDbCriteria;
$criteria->compare('cart_shoping_header_id',$id);
$purchases_detailDataProvider=new CActiveDataProvider('CartShoppingDetail',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'purchases_detail'=>$purchases_detail,
	'purchases_detailDataProvider'=>$purchases_detailDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../purchases_detail/view_embed',array(
	'model'=>$model,
	'purchases_detailDataProvider'=>$purchases_detailDataProvider,
	'purchases_detail'=>$purchases_detail,
))?>

 */
?>

<div class="col-lg-12 text-right">
<?php #echo CHtml::link('<i class="fa fa-plus-circle"></i>', array('purchases_detail/create','cart_shoping_header_id'=>$model->id),
#array('class'=>'btn btn-primary','data-action'=>'crud-purchases_detail','data-type'=>'create')); ?>
</div>

<h4><i class="fa fa-qrcode"></i> <?php echo Yii::t('app','Purchases Detail')?> <span class="loading"></span></h4>

<table class="table">
	<tr>
		<!-- <th>Producto</th> -->
		<th>Nombre</th>
		<th>Descripción</th>
		<th>Cantidad</th>
		<th>Valor unitario</th>
		<th>Total</th>
	</tr>
	<?php $subTotal=0?>
	<?php foreach($model->items as $i => $data):?>
	<?php
		$row=CActiveRecord::model($data->table_related)->findByPk($data->product_id);
		$modelFields=$this->module->typesAllowed[$data->table_related];
		$modelId=$modelFields['id'];
		$modelUnitValue=$modelFields['unit_value'];
		$modelName=$modelFields['name'];
		$modelImage=$modelFields['image'];
		$modelDescription=$modelFields['description'];
		$modelExtra=$modelFields['extra'];

		if($row===null)
			continue;
	?>
	<tr>
		<!-- <td><img class="img-responsive img-thumbnail" style="width:60px" src="<?php echo Yii::app()->request->baseUrl?>/uploads/<?php echo $row->{$modelImage}?>" alt=""></td> -->
		<td><?php echo $row->{$modelName}?></td>
		<td><?php echo substr($row->{$modelDescription}, 0,60)."..."?></td>
		<td>
			<?php echo $data->quantity?>
		</td>
		<td class="data-item-<?php echo $i?>">$<?php echo number_format($row->{$modelUnitValue})?></td>
		<td class="data-item-<?php echo $i?>-total">$<?php echo number_format(($row->{$modelUnitValue})*$data->quantity)?></td>
	</tr>

	<?php $subTotal+=(($row->{$modelUnitValue})*$data->quantity)?>
	<?php endforeach;?>

</table>
	<?php #$subTotal?>

<?php $overallTax=$this->module->overall_tax?>
<?php $totalTax=$this->module->tax($overallTax,$subTotal);?>
<?php $shippingCost=$model->shipping_cost?>
<?php $total=($subTotal+$totalTax+$shippingCost)?>
<table class="table">
	<tr>
		<td></td>
		<td></td>
		<td class="text-right"><strong>SUBTOTAL</strong></td>
		<td class="text-right" style="width:120px">$<?php echo number_format($subTotal)?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td class="text-right"><strong>IVA</strong></td>
		<td class="text-right" style="width:120px">$<?php echo number_format($totalTax)?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td class="text-right"><strong>ENVÍO</strong></td>
		<td class="text-right" style="width:120px">$<?php echo number_format($shippingCost)?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td class="text-right"><strong>TOTAL</strong></td>
		<td class="text-right" style="width:120px">$<?php echo number_format($total)?></td>
	</tr>
</table>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to update or create a detail record -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="cart-shopping-detail-modal" tabindex="-1" role="cart-shopping-detail-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-qrcode"></i> <?php echo Yii::t('app','Purchases Detail')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../purchases_detail/_detail_form',array('model'=>$purchases_detail))?>
        </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="cart-shopping-detail-view-modal" tabindex="-1" role="cart-shopping-detail-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-qrcode"></i> <?php echo Yii::t('app','Purchases Detail')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../purchases_detail/_detail_view',array('model'=>$purchases_detail))?>
        </div>
        </div>
    </div>
</div>
<script>
$(function () {
	$(document).on('click', '[data-action=crud-purchases_detail]', function (e) {
   		e.preventDefault();
			var action = $(this).attr('href');
			var type = $(this).attr('data-type');

   		if(type==='update') {
	   		$.ajax({
	   			url: action,
	   			dataType: 'json',
	   			success: function (data) {
	   				// fill data to update
	   				console.log(data);
	   				$('#cart-shopping-detail-form').attr('action',action);
					$('#CartShoppingDetail_id').val(data.id);
					$('#CartShoppingDetail_cart_shoping_header_id').val(data.cart_shoping_header_id);
					$('#CartShoppingDetail_product_id').val(data.product_id);
					$('#CartShoppingDetail_table_related').val(data.table_related);
					$('#CartShoppingDetail_unit_value').val(data.unit_value);
					$('#CartShoppingDetail_currency').val(data.currency);
					$('#CartShoppingDetail_quantity').val(data.quantity);
					$('#CartShoppingDetail_tax_rate').val(data.tax_rate);
					$('#CartShoppingDetail_created_at').val(data.created_at);
					$('.cart-shopping-detail-submit').val('Guardar');
					$('#cart-shopping-detail-modal').modal('show');
	   			}
	   		});
   		}

   		if(type==='view') {
				$.ajax({
	   			url: action,
	   			dataType: 'json',
	   			success: function (data) {
	   				// fill data to update
	   				console.log(data);
					$('#CartShoppingDetail_id_label').html(data.id);
					$('#CartShoppingDetail_cart_shoping_header_id_label').html(data.cart_shoping_header_id);
					$('#CartShoppingDetail_product_id_label').html(data.product_id);
					$('#CartShoppingDetail_table_related_label').html(data.table_related);
					$('#CartShoppingDetail_unit_value_label').html(data.unit_value);
					$('#CartShoppingDetail_currency_label').html(data.currency);
					$('#CartShoppingDetail_quantity_label').html(data.quantity);
					$('#CartShoppingDetail_tax_rate_label').html(data.tax_rate);
					$('#CartShoppingDetail_created_at_label').html(data.created_at);
					$('#cart-shopping-detail-view-modal').modal('show');
	   			}
	   		});
   		}

   		if(type==='create') {
				$('#cart-shopping-detail-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.cart-shopping-detail-submit').val('Crear');
	   				$('#cart-shopping-detail-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('cart-shopping-detail-list');
		                }
		            });
		        }
		    });
   		}
    });

});
</script>
