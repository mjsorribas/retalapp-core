<?php
/* @var $this UpdatesController */
/* @var $model ShoppingUpdates */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$updates=new ShoppingUpdates;
$criteria=new CDbCriteria;
$criteria->compare('shopping_items_id',$id);
$updatesDataProvider=new CActiveDataProvider('ShoppingUpdates',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'updates'=>$updates,
	'updatesDataProvider'=>$updatesDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../updates/view_embed',array(
	'model'=>$model,
	'updatesDataProvider'=>$updatesDataProvider,
	'updates'=>$updates,
))?>

 */
?>

<?php #if(count($updatesDataProvider->getData())<12):?>
<div class="col-lg-12 text-right">
<?php echo CHtml::link('<i class="fa fa-plus-circle"></i>', array('updates/create','shopping_items_id'=>$model->id), 
array('class'=>'btn btn-primary','data-action'=>'crud-updates','data-type'=>'create')); ?>
</div>
<?php #endif;?>

<h4><i class="fa fa-envelope"></i> <?php echo Yii::t('app','Notificar actualización')?> <span class="loading"></span></h4>
<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'shopping-updates-list',
	'dataProvider'=>$updatesDataProvider,
	'itemView'=>'../updates/_detail_each',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'itemsTagName'=>'ul',
	'cssFile'=>false,
	'itemsCssClass'=>'list-group',
	'summaryCssClass'=>'text-right',
)); ?>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to update or create a detail record -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="shopping-updates-modal" tabindex="-1" role="shopping-updates-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-envelope"></i> <?php echo Yii::t('app','Notificar actualización')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../updates/_detail_form',array('model'=>$updates))?>
        </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="shopping-updates-view-modal" tabindex="-1" role="shopping-updates-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-envelope"></i> <?php echo Yii::t('app','Notificar actualización')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../updates/_detail_view',array('model'=>$updates))?>
        </div>
        </div>
    </div>
</div>
<script>
$(function () {
	$(document).on('click', '[data-action=crud-updates]', function (e) {
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
	   				$('#shopping-updates-form').attr('action',action);
					$('#ShoppingUpdates_id').val(data.id);
					$('#ShoppingUpdates_message').val(data.message);
					$('#ShoppingUpdates_orden_id').val(data.orden_id);
					$('#ShoppingUpdates_shopping_items_id').val(data.shopping_items_id);
					$('#ShoppingUpdates_created_at').val(data.created_at);
					$('.shopping-updates-submit').val('Guardar');
					$('#shopping-updates-modal').modal('show');
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
					$('#ShoppingUpdates_id_label').html(data.id);
					$('#ShoppingUpdates_message_label').html(data.message);
					$('#ShoppingUpdates_orden_id_label').html(data.orden_id);
					$('#ShoppingUpdates_shopping_items_id_label').html(data.shopping_items_id);
					$('#ShoppingUpdates_created_at_label').html(data.created_at);
					$('#shopping-updates-view-modal').modal('show');
	   			}
	   		});
   		} 
   		
   		if(type==='create') {
				$('#shopping-updates-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.shopping-updates-submit').val('Crear');
	   				$('#shopping-updates-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('shopping-updates-list');
		                }
		            });
		        }
		    });
   		}
    });

	$("#shopping-updates-list ul").sortable({
    	update: function() {
    		var that = $(this);
			$('.loading').html('<i class="fa fa-refresh fa-spin"></i>');
    		setTimeout(function () {
	        	var order = that.sortable("toArray");
		        $.post('<?php echo $this->createUrl("updates/order") ?>', {order: order}, function(datos){
	    			$('.loading').empty();
		        });
    		},500);
        }
    });
});
</script>