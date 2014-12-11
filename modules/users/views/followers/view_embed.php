<?php
/* @var $this FollowersController */
/* @var $model UsersFollowers */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$followers=new UsersFollowers;
$criteria=new CDbCriteria;
$criteria->compare('users_users_id',$id);
$followersDataProvider=new CActiveDataProvider('UsersFollowers',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'followers'=>$followers,
	'followersDataProvider'=>$followersDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../followers/view_embed',array(
	'model'=>$model,
	'followersDataProvider'=>$followersDataProvider,
	'followers'=>$followers,
))?>

 */
?>

<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'users-followers-list',
	'dataProvider'=>$followersDataProvider,
	'itemView'=>'../followers/_detail_each',
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
<div class="modal fade" id="users-followers-modal" tabindex="-1" role="users-followers-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-question"></i> <?php echo Yii::t('app','Followers')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../followers/_detail_form',array('model'=>$followers))?>
        </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<!-- Modal in order to view detail of -->
<!-- ////////////////////////////////////////////////// -->
<div class="modal fade" id="users-followers-view-modal" tabindex="-1" role="users-followers-view-modal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title"><i class="fa fa-question"></i> <?php echo Yii::t('app','Followers')?></h4>
        </div>
    	<div class="modal-body">
        	<?php echo $this->renderPartial('../followers/_detail_view',array('model'=>$followers))?>
        </div>
        </div>
    </div>
</div>
<script>
$(function () {
	$(document).on('click', '[data-action=crud-followers]', function (e) {
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
	   				$('#users-followers-form').attr('action',action);
					$('#UsersFollowers_id').val(data.id);
					$('#UsersFollowers_users_users_id').val(data.users_users_id);
					$('#UsersFollowers_users_follower_id').val(data.users_follower_id);
					$('#UsersFollowers_created_at').val(data.created_at);
					$('.users-followers-submit').val('Guardar');
					$('#users-followers-modal').modal('show');
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
					$('#UsersFollowers_id_label').html(data.id);
					$('#UsersFollowers_users_users_id_label').html(data.users_users_id);
					$('#UsersFollowers_users_follower_id_label').html(data.users_follower_id);
					$('#UsersFollowers_created_at_label').html(data.created_at);
					$('#users-followers-view-modal').modal('show');
	   			}
	   		});
   		} 
   		
   		if(type==='create') {
				$('#users-followers-form').attr('action',action).each(function(i,v){
	              this.reset();
	            });
					$('.users-followers-submit').val('Crear');
	   				$('#users-followers-modal').modal('show');
   		}

   		if(type==='delete') {
			var name = $(this).attr('data-name');
		    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro "+name+"?", function(result) {
		        if(result) {
		            $.ajax({
		                type: 'post',
		                url: action,
		                success:function (data) {
		                    $.fn.yiiListView.update('users-followers-list');
		                }
		            });
		        }
		    });
   		}
    });

});
</script>