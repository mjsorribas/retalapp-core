<?php
/* @var $this MaterialController */
/* @var $model ShoppingMaterial */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$material=new ShoppingMaterial;
$criteria=new CDbCriteria;
$criteria->compare('shopping_items_id',$id);
$materialDataProvider=new CActiveDataProvider('ShoppingMaterial',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'material'=>$material,
	'materialDataProvider'=>$materialDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../material/view_embed',array(
	'model'=>$model,
	'materialDataProvider'=>$materialDataProvider,
	'material'=>$material,
))?>

 */
?>

<?php #if(count($materialDataProvider->getData())<12):?>
<div class="col-lg-12 text-right">
<?php echo CHtml::link('<i class="fa fa-plus-circle"></i>', array('material/create','shopping_items_id'=>$model->id), 
array('class'=>'btn btn-primary','data-action'=>'crud-material','data-type'=>'create')); ?>
</div>
<?php #endif;?>

<h4><i class="fa fa-list-ol"></i> <?php echo Yii::t('app','Material incluido')?> <span class="loading"></span></h4>
<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'shopping-material-list',
	'dataProvider'=>$materialDataProvider,
	'itemView'=>'../material/_detail_each',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'itemsTagName'=>'ul',
	'cssFile'=>false,
	'itemsCssClass'=>'list-group',
	'summaryCssClass'=>'text-right',
)); ?>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to update or create a detail record -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="shopping-material-modal" tabindex="-1" role="shopping-material-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-list-ol"></i> <?php echo Yii::t('app','Material incluido')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../material/_detail_form',array('model'=>$material))?>
        </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="shopping-material-view-modal" tabindex="-1" role="shopping-material-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-list-ol"></i> <?php echo Yii::t('app','Material incluido')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../material/_detail_view',array('model'=>$material))?>
        </div>
        </div>
    </div>
</div>
<script>
$(function () {
	$(document).on('click', '[data-action=crud-material]', function (e) {
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
	   				$('#shopping-material-form').attr('action',action);
					$('#ShoppingMaterial_id').val(data.id);
					$('#ShoppingMaterial_nombre').val(data.nombre);
					$('#ShoppingMaterial_orden_id').val(data.orden_id);
					$('#ShoppingMaterial_shopping_items_id').val(data.shopping_items_id);
					$('.shopping-material-submit').val('Guardar');
					$('#shopping-material-modal').modal('show');
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
					$('#ShoppingMaterial_id_label').html(data.id);
					$('#ShoppingMaterial_nombre_label').html(data.nombre);
					$('#ShoppingMaterial_orden_id_label').html(data.orden_id);
					$('#ShoppingMaterial_shopping_items_id_label').html(data.shopping_items_id);
					$('#shopping-material-view-modal').modal('show');
	   			}
	   		});
   		} 
   		
   		if(type==='create') {
				$('#shopping-material-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.shopping-material-submit').val('Crear');
	   				$('#shopping-material-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('shopping-material-list');
		                }
		            });
		        }
		    });
   		}
    });

	$("#shopping-material-list ul").sortable({
    	update: function() {
    		var that = $(this);
			$('.loading').html('<i class="fa fa-refresh fa-spin"></i>');
    		setTimeout(function () {
	        	var order = that.sortable("toArray");
		        $.post('<?php echo $this->createUrl("material/order") ?>', {order: order}, function(datos){
	    			$('.loading').empty();
		        });
    		},500);
        }
    });
});
</script>