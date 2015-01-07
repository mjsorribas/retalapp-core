<?php
/* @var $this Codes_upload_modalController */
/* @var $model CartSecretCodes */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$codes_upload_modal=new CartSecretCodes;
$criteria=new CDbCriteria;
$criteria->compare('cart_upload_id',$id);
$codes_upload_modalDataProvider=new CActiveDataProvider('CartSecretCodes',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'codes_upload_modal'=>$codes_upload_modal,
	'codes_upload_modalDataProvider'=>$codes_upload_modalDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../codes_upload_modal/view_embed',array(
	'model'=>$model,
	'codes_upload_modalDataProvider'=>$codes_upload_modalDataProvider,
	'codes_upload_modal'=>$codes_upload_modal,
))?>

 */
?>

<div class="col-lg-12 text-right">
<?php #echo CHtml::link('<i class="fa fa-plus-circle"></i>', array('codes_upload_modal/create','cart_upload_id'=>$model->id), 
#array('class'=>'btn btn-primary','data-action'=>'crud-codes_upload_modal','data-type'=>'create')); ?>
</div>

<h4><i class="fa fa-barcode"></i> <?php echo Yii::t('app','Codes')?> <span class="loading"></span></h4>
<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'cart-secret-codes-list',
	'dataProvider'=>$codes_upload_modalDataProvider,
	'itemView'=>'../codes_upload_modal/_detail_each',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'itemsTagName'=>'ul',
	'cssFile'=>false,
	'itemsCssClass'=>'list-group',
	'summaryCssClass'=>'text-right',
)); ?>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to update or create a detail record -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="cart-secret-codes-modal" tabindex="-1" role="cart-secret-codes-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-barcode"></i> <?php echo Yii::t('app','Codes')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../codes_upload_modal/_detail_form',array('model'=>$codes_upload_modal))?>
        </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="cart-secret-codes-view-modal" tabindex="-1" role="cart-secret-codes-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-barcode"></i> <?php echo Yii::t('app','Codes')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../codes_upload_modal/_detail_view',array('model'=>$codes_upload_modal))?>
        </div>
        </div>
    </div>
</div>
<script>
$(function () {
	$(document).on('click', '[data-action=crud-codes_upload_modal]', function (e) {
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
	   				$('#cart-secret-codes-form').attr('action',action);
					$('#CartSecretCodes_id').val(data.id);
					$('#CartSecretCodes_secret_code').val(data.secret_code);
					$('#CartSecretCodes_created_at').val(data.created_at);
					$('#CartSecretCodes_state').attr('checked',data.state);
					$('#CartSecretCodes_cart_upload_id').val(data.cart_upload_id);
					$('.cart-secret-codes-submit').val('Guardar');
					$('#cart-secret-codes-modal').modal('show');
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
					$('#CartSecretCodes_id_label').html(data.id);
					$('#CartSecretCodes_secret_code_label').html(data.secret_code);
					$('#CartSecretCodes_created_at_label').html(data.created_at);
					$('#CartSecretCodes_state_label').html(data.state);
					$('#CartSecretCodes_cart_upload_id_label').html(data.cart_upload_id);
					$('#cart-secret-codes-view-modal').modal('show');
	   			}
	   		});
   		} 
   		
   		if(type==='create') {
				$('#cart-secret-codes-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.cart-secret-codes-submit').val('Crear');
	   				$('#cart-secret-codes-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('cart-secret-codes-list');
		                }
		            });
		        }
		    });
   		}
    });

});
</script>