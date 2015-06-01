<?php
/* @var $this FeaturesController */
/* @var $model LandingFeatures */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$features=new LandingFeatures;
$criteria=new CDbCriteria;
$criteria->compare('landing_pages_id',$id);
$featuresDataProvider=new CActiveDataProvider('LandingFeatures',array(
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

<?php #if(count($featuresDataProvider->getData())<12):?>
<div class="col-lg-12 text-right">
<?php echo CHtml::link('<i class="fa fa-plus-circle"></i>', array('features/create','landing_pages_id'=>$model->id), 
array('class'=>'btn btn-primary','data-action'=>'crud-features','data-type'=>'create')); ?>
</div>
<?php #endif;?>

<h4><i class="fa fa-list-ol"></i> <?php echo Yii::t('app','Features')?> <span class="loading"></span></h4>
<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'landing-features-list',
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
<div class="modal fade" id="landing-features-modal" tabindex="-1" role="landing-features-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-list-ol"></i> <?php echo Yii::t('app','Features')?></h4>
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
<div class="modal fade" id="landing-features-view-modal" tabindex="-1" role="landing-features-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-list-ol"></i> <?php echo Yii::t('app','Features')?></h4>
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
	   				$('#landing-features-form').attr('action',action);
					$('#LandingFeatures_id').val(data.id);
					$('#LandingFeatures_name').val(data.name);
					$('#LandingFeatures_description').val(data.description);
					$('#LandingFeatures_icon').val(data.icon);
					$('#LandingFeatures_landing_pages_id').val(data.landing_pages_id);
					$('#LandingFeatures_orden_id').val(data.orden_id);
					$('.landing-features-submit').val('Guardar');
					$('#landing-features-modal').modal('show');
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
					$('#LandingFeatures_id_label').html(data.id);
					$('#LandingFeatures_name_label').html(data.name);
					$('#LandingFeatures_description_label').html(data.description);
					$('#LandingFeatures_icon_label').html(data.icon);
					$('#LandingFeatures_landing_pages_id_label').html(data.landing_pages_id);
					$('#LandingFeatures_orden_id_label').html(data.orden_id);
					$('#landing-features-view-modal').modal('show');
	   			}
	   		});
   		} 
   		
   		if(type==='create') {
				$('#landing-features-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.landing-features-submit').val('Crear');
	   				$('#landing-features-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('landing-features-list');
		                }
		            });
		        }
		    });
   		}
    });

	$("#landing-features-list ul").sortable({
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