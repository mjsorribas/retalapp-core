<?php
/* @var $this FeaturesController */
/* @var $model PriceFeatures */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$features=new PriceFeatures;
$criteria=new CDbCriteria;
$criteria->compare('price_items_id',$id);
$featuresDataProvider=new CActiveDataProvider('PriceFeatures',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'features'=>$features,
	'featuresDataProvider'=>$featuresDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../features/view_embed',array(
	'model'=>$model,
	'featuresDataProvider'=>$featuresDataProvider,
	'features'=>$features,
))?>

 */
?>

<div class="col-lg-12 text-right">
<?php echo CHtml::link('<i class="fa fa-plus-circle"></i>', array('features/create','price_items_id'=>$model->id), 
array('class'=>'btn btn-primary','data-action'=>'crud-features','data-type'=>'create')); ?>
</div>

<h4><i class="fa fa-star-o"></i> <?php echo Yii::t('app','Features per Price')?> <span class="loading"></span></h4>
<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'price-features-list',
	'dataProvider'=>$featuresDataProvider,
	'itemView'=>'../features/_detail_each',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'itemsTagName'=>'ul',
	'cssFile'=>false,
	'itemsCssClass'=>'list-group',
	'summaryCssClass'=>'text-right',
)); ?>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to update or create a detail record -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="price-features-modal" tabindex="-1" role="price-features-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-star-o"></i> <?php echo Yii::t('app','Features per Price')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../features/_detail_form',array('model'=>$features))?>
        </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="price-features-view-modal" tabindex="-1" role="price-features-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-star-o"></i> <?php echo Yii::t('app','Features per Price')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../features/_detail_view',array('model'=>$features))?>
        </div>
        </div>
    </div>
</div>
<script>
$(function () {
	$(document).on('click', '[data-action=crud-features]', function (e) {
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
	   				$('#price-features-form').attr('action',action);
					$('#PriceFeatures_id').val(data.id);
					$('#PriceFeatures_icon').val(data.icon);
					$('#PriceFeatures_name').val(data.name);
					$('#PriceFeatures_price_items_id').val(data.price_items_id);
					$('#PriceFeatures_orden_id').val(data.orden_id);
					$('.price-features-submit').val('Save');
					$('#price-features-modal').modal('show');
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
					$('#PriceFeatures_id_label').html(data.id);
					$('#PriceFeatures_icon_label').html(data.icon);
					$('#PriceFeatures_name_label').html(data.name);
					$('#PriceFeatures_price_items_id_label').html(data.price_items_id);
					$('#PriceFeatures_orden_id_label').html(data.orden_id);
					$('#price-features-view-modal').modal('show');
	   			}
	   		});
   		} 
   		
   		if(type==='create') {
				$('#price-features-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.price-features-submit').val('Create');
	   				$('#price-features-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('price-features-list');
		                }
		            });
		        }
		    });
   		}
    });

	$("#price-features-list ul").sortable({
    	update: function() {
    		var that = $(this);
			$('.loading').html('<i class="fa fa-refresh fa-spin"></i>');
    		setTimeout(function () {
	        	var order = that.sortable("toArray");
		        $.post('<?php echo $this->createUrl("features/order") ?>', {order: order}, function(datos){
	    			$('.loading').empty();
		        });
    		},500);
        }
    });
});
</script>