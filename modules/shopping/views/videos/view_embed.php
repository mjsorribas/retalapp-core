<?php
/* @var $this VideosController */
/* @var $model ShoppingVideos */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$videos=new ShoppingVideos;
$criteria=new CDbCriteria;
$criteria->compare('shopping_items_id',$id);
$videosDataProvider=new CActiveDataProvider('ShoppingVideos',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'videos'=>$videos,
	'videosDataProvider'=>$videosDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../videos/view_embed',array(
	'model'=>$model,
	'videosDataProvider'=>$videosDataProvider,
	'videos'=>$videos,
))?>

 */
?>

<?php #if(count($videosDataProvider->getData())<12):?>
<div class="col-lg-12 text-right">
<?php echo CHtml::link('<i class="fa fa-plus-circle"></i>', array('videos/create','shopping_items_id'=>$model->id), 
array('class'=>'btn btn-primary','data-action'=>'crud-videos','data-type'=>'create')); ?>
</div>
<?php #endif;?>

<h4><i class="fa fa-youtube-play"></i> <?php echo Yii::t('app','Videos de este curso')?> <span class="loading"></span></h4>
<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'shopping-videos-list',
	'dataProvider'=>$videosDataProvider,
	'itemView'=>'../videos/_detail_each',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'itemsTagName'=>'ul',
	'cssFile'=>false,
	'itemsCssClass'=>'list-group',
	'summaryCssClass'=>'text-right',
)); ?>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to update or create a detail record -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="shopping-videos-modal" tabindex="-1" role="shopping-videos-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-youtube-play"></i> <?php echo Yii::t('app','Videos de este curso')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../videos/_detail_form',array('model'=>$videos))?>
        </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="shopping-videos-view-modal" tabindex="-1" role="shopping-videos-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-youtube-play"></i> <?php echo Yii::t('app','Videos de este curso')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../videos/_detail_view',array('model'=>$videos))?>
        </div>
        </div>
    </div>
</div>
<script>
$(function () {
	$(document).on('click', '[data-action=crud-videos]', function (e) {
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
	   				$('#shopping-videos-form').attr('action',action);
					$('#ShoppingVideos_id').val(data.id);
					$('#ShoppingVideos_link').val(data.link);
					$('#ShoppingVideos_link_vimeo').val(data.link_vimeo);
					$('#ShoppingVideos_titulo').val(data.titulo);
					$('#ShoppingVideos_descripcion').val(data.descripcion);
					$('#ShoppingVideos_orden_id').val(data.orden_id);
					$('#ShoppingVideos_shopping_items_id').val(data.shopping_items_id);
					$('.shopping-videos-submit').val('Guardar');
					$('#shopping-videos-modal').modal('show');
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
					$('#ShoppingVideos_id_label').html(data.id);
					$('#ShoppingVideos_link_label').html(data.link);
					$('#ShoppingVideos_link_vimeo_label').html(data.link_vimeo);
					$('#ShoppingVideos_titulo_label').html(data.titulo);
					$('#ShoppingVideos_descripcion_label').html(data.descripcion);
					$('#ShoppingVideos_orden_id_label').html(data.orden_id);
					$('#ShoppingVideos_shopping_items_id_label').html(data.shopping_items_id);
					$('#shopping-videos-view-modal').modal('show');
	   			}
	   		});
   		} 
   		
   		if(type==='create') {
				$('#shopping-videos-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.shopping-videos-submit').val('Crear');
	   				$('#shopping-videos-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('shopping-videos-list');
		                }
		            });
		        }
		    });
   		}
    });

	$("#shopping-videos-list ul").sortable({
    	update: function() {
    		var that = $(this);
			$('.loading').html('<i class="fa fa-refresh fa-spin"></i>');
    		setTimeout(function () {
	        	var order = that.sortable("toArray");
		        $.post('<?php echo $this->createUrl("videos/order") ?>', {order: order}, function(datos){
	    			$('.loading').empty();
		        });
    		},500);
        }
    });
});
</script>