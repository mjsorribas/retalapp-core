<?php
/* @var $this ImagesController */
/* @var $model ShoppingImages */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$images=new ShoppingImages;
$criteria=new CDbCriteria;
$criteria->compare('shopping_items_id',$id);
$imagesDataProvider=new CActiveDataProvider('ShoppingImages',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'images'=>$images,
	'imagesDataProvider'=>$imagesDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../images/view_embed',array(
	'model'=>$model,
	'imagesDataProvider'=>$imagesDataProvider,
	'images'=>$images,
))?>

 */
?>

<?php #if(count($imagesDataProvider->getData())<12):?>
<div class="col-lg-12 text-right">
<?php echo CHtml::link('<i class="fa fa-plus-circle"></i>', array('images/create','shopping_items_id'=>$model->id), 
array('class'=>'btn btn-primary','data-action'=>'crud-images','data-type'=>'create')); ?>
</div>
<?php #endif;?>

<h4><i class="fa fa-file-image-o"></i> <?php echo Yii::t('app','Imágenes')?> <span class="loading"></span></h4>
<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'shopping-images-list',
	'dataProvider'=>$imagesDataProvider,
	'itemView'=>'../images/_detail_each',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'itemsTagName'=>'ul',
	'cssFile'=>false,
	'itemsCssClass'=>'list-group',
	'summaryCssClass'=>'text-right',
)); ?>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to update or create a detail record -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="shopping-images-modal" tabindex="-1" role="shopping-images-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-file-image-o"></i> <?php echo Yii::t('app','Imágenes')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../images/_detail_form',array('model'=>$images))?>
        </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="shopping-images-view-modal" tabindex="-1" role="shopping-images-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-file-image-o"></i> <?php echo Yii::t('app','Imágenes')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../images/_detail_view',array('model'=>$images))?>
        </div>
        </div>
    </div>
</div>
<script>
$(function () {
	$(document).on('click', '[data-action=crud-images]', function (e) {
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
	   				$('#shopping-images-form').attr('action',action);
					$('#ShoppingImages_id').val(data.id);
					$('.stick-image').empty();
					$('#ShoppingImages_image').val('');
					$('#ShoppingImages_image').val(data.image);
					$('.stick-image.ShoppingImages_image_img').html('<img class="img-responsive img-rounded" src="'+$('.ShoppingImages_image_img').attr('data-url')+'/'+data.image+'" alt="">');
					$('#ShoppingImages_orden_id').val(data.orden_id);
					$('#ShoppingImages_shopping_items_id').val(data.shopping_items_id);
					$('.shopping-images-submit').val('Save');
					$('#shopping-images-modal').modal('show');
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
					$('#ShoppingImages_id_label').html(data.id);
					$('#ShoppingImages_image_label').html(data.image);
					$('#ShoppingImages_orden_id_label').html(data.orden_id);
					$('#ShoppingImages_shopping_items_id_label').html(data.shopping_items_id);
					$('#shopping-images-view-modal').modal('show');
	   			}
	   		});
   		} 
   		
   		if(type==='create') {
				$('#shopping-images-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.stick-image').empty();
					$('#ShoppingImages_image').val('');
					$('.shopping-images-submit').val('Create');
	   				$('#shopping-images-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('shopping-images-list');
		                }
		            });
		        }
		    });
   		}
    });

	$("#shopping-images-list ul").sortable({
    	update: function() {
    		var that = $(this);
			$('.loading').html('<i class="fa fa-refresh fa-spin"></i>');
    		setTimeout(function () {
	        	var order = that.sortable("toArray");
		        $.post('<?php echo $this->createUrl("images/order") ?>', {order: order}, function(datos){
	    			$('.loading').empty();
		        });
    		},500);
        }
    });
});
</script>