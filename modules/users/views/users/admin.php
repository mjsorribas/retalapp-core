<?php
/* @var $this UsersController */
/* @var $model UsersUsers */

$this->breadcrumbs=array(
	'Users'=>array('admin'),
	'Lista de Users',
);
 ?><div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
    	<?php echo CHtml::link('<i class="fa fa-plus"></i> '.Yii::t('app','Create'),array('create'),array('class'=>'btn btn-primary'))?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-users-grid',
	'itemsCssClass'=>'table table-inbox table-hover',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'dataProvider'=>$model->search(),
	'summaryCssClass'=>'text-right',
	'filter'=>$model,	'columns'=>array(
		array(
			'name'=>'id',
			'type'=>'raw',
			'value'=>'$data->id',
		),
		array(
			'name'=>'img',
			'filter'=>false,
			'type'=>'raw',
			'value'=>'CHtml::image($data->imageUrl,"",array("class"=>"img-responsive img-thumbnail","style"=>"max-width:100px"))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'$data->email."<br> <span class=\"text-muted\">".r()->format->agoComment($data->registered)."</span>"',
		),
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'$data->name',
		),
		/*
		array(
			'name'=>'lastname',
			'type'=>'raw',
			'value'=>'$data->lastname',
		),
		array(
			'name'=>'username',
			'type'=>'raw',
			'value'=>'$data->username',
		),
		array(
			'name'=>'state',
			'filter'=>array('1'=>Yii::t("app","Enabled"),'0'=>Yii::t("app","Disabled")),
			'type'=>'raw',
			'value'=>'($data->state)?"<span class=\"label label-success\">".Yii::t("app","State")." ".Yii::t("app","Enabled")."</span>":"<span class=\"label label-danger\">".Yii::t("app","State")." ".Yii::t("app","Disabled")."</span>"',
		),
		array(
			'name'=>'state_email',
			'filter'=>array('1'=>Yii::t("app","Enabled"),'0'=>Yii::t("app","Disabled")),
			'type'=>'raw',
			'value'=>'($data->state_email)?"<span class=\"label label-success\">".Yii::t("app","State Email")." ".Yii::t("app","Enabled")."</span>":"<span class=\"label label-danger\">".Yii::t("app","State Email")." ".Yii::t("app","Disabled")."</span>"',
		),
		array(
			'name'=>'registered',
			'type'=>'raw',
			'value'=>'$data->registered',
		),
		array(
			'name'=>'trash',
			'filter'=>array('1'=>Yii::t("app","Enabled"),'0'=>Yii::t("app","Disabled")),
			'type'=>'raw',
			'value'=>'($data->trash)?"<span class=\"label label-success\">".Yii::t("app","Trash")." ".Yii::t("app","Enabled")."</span>":"<span class=\"label label-danger\">".Yii::t("app","Trash")." ".Yii::t("app","Disabled")."</span>"',
		),
		*/
		/*array(
			'class'=>'CButtonColumn',
		),*/
		array(
			'class'=>'CLinkColumn',
			'label'=>Yii::t('app','View'),
			'htmlOptions'=>array('style'=>'width:60px'),
			'urlExpression'=>'Yii::app()->controller->createUrl("view",array("id"=>$data->primaryKey))',
			'linkHtmlOptions'=>array('class'=>'btn btn-success'),
		),
		array(
			'class'=>'CLinkColumn',
			'label'=>Yii::t('app','Update'),
			'htmlOptions'=>array('style'=>'width:60px'),
			'urlExpression'=>'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
			'linkHtmlOptions'=>array('class'=>'btn btn-primary'),
		),
		array(
			'class'=>'CLinkColumn',
			'label'=>Yii::t('app','Delete'),
			'htmlOptions'=>array('style'=>'width:60px'),
			'urlExpression'=>'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))',
			'linkHtmlOptions'=>array('class'=>'btn btn-danger','data-action'=>'delete'),
		),
	),
)); ?>
		</div>
    </div>
</section>
</div>
<script>
$(function() {
	/**
	 * This event delete or publish an Item
	 * according to selected Item
	*/
	$(document).on('click','[data-action=delete]',function(e){
	    e.preventDefault();
	    var href = $(this).attr('href');
	    bootbox.confirm("¿Está seguro que desea <strong>BORRAR</strong> el registro seleccionado?", function(result) {
	        if(result) {
	            $.ajax({
	                url: href,
	                success:function (data) {
	                    $.fn.yiiGridView.update('users-users-grid');
	                }
	            });
	        }
	    });
	});

});
</script>