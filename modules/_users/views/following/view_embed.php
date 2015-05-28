<?php
/* @var $this FollowingController */
/* @var $model UsersFollowing */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$following=new UsersFollowing;
$criteria=new CDbCriteria;
$criteria->compare('users_users_id',$id);
$followingDataProvider=new CActiveDataProvider('UsersFollowing',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'following'=>$following,
	'followingDataProvider'=>$followingDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../following/view_embed',array(
	'model'=>$model,
	'followingDataProvider'=>$followingDataProvider,
	'following'=>$following,
))?>

 */
?>
<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'users-following-list',
	'dataProvider'=>$followingDataProvider,
	'itemView'=>'../following/_detail_each',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'itemsTagName'=>'ul',
	'cssFile'=>false,
	'template'=>"{items} {pager}",
	'itemsCssClass'=>'list-group',
	'summaryCssClass'=>'text-right',
)); ?>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to update or create a detail record -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="users-following-modal" tabindex="-1" role="users-following-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-question"></i> <?php echo Yii::t('app','Following')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../following/_detail_form',array('model'=>$following))?>
        </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="users-following-view-modal" tabindex="-1" role="users-following-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-question"></i> <?php echo Yii::t('app','Following')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../following/_detail_view',array('model'=>$following))?>
        </div>
        </div>
    </div>
</div>
<script>
$(function () {
	$(document).on('click', '[data-action=crud-following]', function (e) {
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
	   				$('#users-following-form').attr('action',action);
					$('#UsersFollowing_id').val(data.id);
					$('#UsersFollowing_users_users_id').val(data.users_users_id);
					$('#UsersFollowing_users_following_id').val(data.users_following_id);
					$('#UsersFollowing_created_at').val(data.created_at);
					$('.users-following-submit').val('Guardar');
					$('#users-following-modal').modal('show');
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
					$('#UsersFollowing_id_label').html(data.id);
					$('#UsersFollowing_users_users_id_label').html(data.users_users_id);
					$('#UsersFollowing_users_following_id_label').html(data.users_following_id);
					$('#UsersFollowing_created_at_label').html(data.created_at);
					$('#users-following-view-modal').modal('show');
	   			}
	   		});
   		} 
   		
   		if(type==='create') {
				$('#users-following-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.users-following-submit').val('Crear');
	   				$('#users-following-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('users-following-list');
		                }
		            });
		        }
		    });
   		}
    });

});
</script>