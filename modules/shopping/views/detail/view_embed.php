<?php
/* @var $this DetailController */
/* @var $model ShoppingDetail */


/* 
////////////////////////////////////////////////
// REPLACE THIS ON VIEW OR UPDATE CONTROLLER  //
////////////////////////////////////////////////

$model=$this->loadModel($id);

$detail=new ShoppingDetail;
$criteria=new CDbCriteria;
$criteria->compare('shopping_header_id',$id);
$detailDataProvider=new CActiveDataProvider('ShoppingDetail',array(
	"criteria"=>$criteria,
));


$typeRender=Yii::app()->request->isAjaxRequest?"renderPartial":"render";
$this->{$typeRender}('view',array(
	'model'=>$model,
	'detail'=>$detail,
	'detailDataProvider'=>$detailDataProvider,
));

////////////////////////////////////////////////////////////
// PASTE THIS CONTENT ON THE VIE OF SAME CONTROLLER ABOVE //
////////////////////////////////////////////////////////////

<?php $this->renderPartial('../detail/view_embed',array(
	'model'=>$model,
	'detailDataProvider'=>$detailDataProvider,
	'detail'=>$detail,
))?>

 */
?>

<h4><i class="fa fa-list-ol"></i> <?php echo Yii::t('app','Detalle de la compra')?> <span class="loading"></span></h4>
<?php if(!isset($email)):?>
<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'shopping-detail-list',
	'dataProvider'=>$detailDataProvider,
	'itemView'=>'../detail/_detail_each',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'itemsTagName'=>'table',
	'cssFile'=>false,
	'itemsCssClass'=>'table tavle-striped',
	'summaryCssClass'=>'text-right',
)); ?>
<?php else:?>
	<?php $this->widget('zii.widgets.CListView',array(
	'id'=>'shopping-detail-list',
	'dataProvider'=>$detailDataProvider,
	'itemView'=>'../detail/_detail_each',
	'pager'=>array('htmlOptions'=>array('class'=>'pagination'),'header'=>false),
	'itemsTagName'=>'table',
	'cssFile'=>false,
	'viewData'=>array('email'=>true),
	'itemsCssClass'=>'table tavle-striped',
	'summaryCssClass'=>'text-right',
	'template'=>'{items}',
)); ?>
<?php endif;?>

