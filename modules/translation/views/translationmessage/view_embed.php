<?php
/* @var $this TranslationmessageController */
/* @var $model TranslationMessage */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$translationmessage=new TranslationMessage;
$criteria=new CDbCriteria;
$criteria->compare('id',$id);
$translationmessageDataProvider=new CActiveDataProvider('TranslationMessage',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'translationmessage'=>$translationmessage,
	'translationmessageDataProvider'=>$translationmessageDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../translationmessage/view_embed',array(
	'model'=>$model,
	'translationmessageDataProvider'=>$translationmessageDataProvider,
	'translationmessage'=>$translationmessage,
))?>

 */
?>

<div class="col-lg-12 text-right">
<?php echo CHtml::link('<i class="fa fa-plus-circle"></i>', array('translationmessage/create','id_id'=>$model->id), 
array('class'=>'btn btn-primary','data-action'=>'crud-translationmessage','data-type'=>'create')); ?>
</div>

<h4><i class="fa fa-language"></i> <?php echo Yii::t('app','Translate Messages')?> <span class="loading"></span></h4>
<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'translation-message-list',
	'dataProvider'=>$translationmessageDataProvider,
	'itemView'=>'../translationmessage/_detail_each',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'itemsTagName'=>'ul',
	'cssFile'=>false,
	'itemsCssClass'=>'list-group',
	'summaryCssClass'=>'text-right',
)); ?>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to update or create a detail record -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="translation-message-modal" tabindex="-1" role="translation-message-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-language"></i> <?php echo Yii::t('app','Translate Messages')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../translationmessage/_detail_form',array('model'=>$translationmessage))?>
        </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="translation-message-view-modal" tabindex="-1" role="translation-message-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-language"></i> <?php echo Yii::t('app','Translate Messages')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../translationmessage/_detail_view',array('model'=>$translationmessage))?>
        </div>
        </div>
    </div>
</div>
<script>
$(function () {
	$(document).on('click', '[data-action=crud-translationmessage]', function (e) {
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
	   				$('#translation-message-form').attr('action',action);
					$('#TranslationMessage_id').val(data.id);
					$('#TranslationMessage_language').val(data.language);
					$('#TranslationMessage_translation').val(data.translation);
					$('#TranslationMessage_id_key').val(data.id_key);
					$('.translation-message-submit').val('Save');
					$('#translation-message-modal').modal('show');
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
					$('#TranslationMessage_id_label').html(data.id);
					$('#TranslationMessage_language_label').html(data.language);
					$('#TranslationMessage_translation_label').html(data.translation);
					$('#TranslationMessage_id_key_label').html(data.id_key);
					$('#translation-message-view-modal').modal('show');
	   			}
	   		});
   		} 
   		
   		if(type==='create') {
				$('#translation-message-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.translation-message-submit').val('Create');
	   				$('#translation-message-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('translation-message-list');
		                }
		            });
		        }
		    });
   		}
    });

});
</script>