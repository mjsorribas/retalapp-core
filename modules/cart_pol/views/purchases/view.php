<?php
/* @var $this PurchasesController */
/* @var $model CartShoppingHeader */

$this->breadcrumbs=array(
	'Purchases'=>array('admin'),
	$model->id,
);

?>
<div class="col-lg-12">
<section class="panel">
    <div class="panel-body minimal">
        <div class="table-inbox-wrap">
    <div class="form-group">
        <div class="text-right">
		<?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>        </div>
    </div>

<div class="row">
    <div class="col-lg-8">
<div class="thumbnail">
    <div class="caption">
    <h4>
      <span class="badge bagde-inverse">REF: <?php echo $model->ref_venta;?></span>
        <?php echo $model->user->name." ".$model->user->lastname;?>    
        <small>    <?php echo Yii::app()->format->formatShort($model->created_at);?>
            <span class="text-muted">
              <?php echo Yii::app()->format->formatAgoComment($model->created_at);?>
            </span>
          
          </small>
    </h4>
    </div>
</div>

<?php $this->renderPartial('../purchases_detail/view_embed',array(
    'model'=>$model,
    'purchases_detailDataProvider'=>$purchases_detailDataProvider,
    'purchases_detail'=>$purchases_detail,
))?>

<?php if($this->module->is_shipping):?>
  <div class="panel panel-default">
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('shipping_data')); ?>:</b></div>
          <div class="panel-body">
            <p>
              <ul class="list-group">
              <li class="list-group-item">
                <strong>Nombre:</strong>
                <p><?php echo $model->user->name?></p>
              </li>
              <li class="list-group-item">
                <strong>Apellido:</strong>
                <p><?php echo $model->user->lastname?></p>
              </li>
              <li class="list-group-item">
                <strong>Fecha de nacimiento:</strong>
                <p><?php echo $model->user->birthdate?></p>
              </li>
              <li class="list-group-item">
                <strong>Ciudad:</strong>
                <p><?php echo (isset($model->user->city) and $model->user->city!==null)?$model->user->city->name:''?></p>
              </li>
              <li class="list-group-item">
                <strong>Dirección de residencia:</strong>
                <p><?php echo $model->user->address?></p>
              </li>
              <li class="list-group-item">
                <strong>Teléfono:</strong>
                <p><?php echo $model->user->phone?></p>
              </li>
              <li class="list-group-item">
                <strong>Email:</strong>
                <p><?php echo $model->user->email?></p>
              </li>
              <li class="list-group-item">
                <strong>Dirección de entrega:</strong>
                <p><?php echo ($model->cart_shipment_data!==null)?$model->cart_shipment_data->address_delivery:'No asignado'?></p>
              </li>
              <li class="list-group-item">
                <strong>Contacto de entrega:</strong>
                <p><?php echo ($model->cart_shipment_data!==null)?$model->cart_shipment_data->contact_receiving:'No asignado'?></p>
              </li>
              <li class="list-group-item">
                <strong>Teléfono de contacto:</strong>
                <p><?php echo ($model->cart_shipment_data!==null)?$model->cart_shipment_data->contact_phone:'No asignado'?></p>
              </li>
              <li class="list-group-item">
                <strong>Comentario:</strong>
                <p><?php echo ($model->cart_shipment_data!==null)?$model->cart_shipment_data->comment:'No asignado'?></p>
              </li>
            </ul>
            </p>
          </div>


        </div>
<?php endif;?>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('cart_states_id')); ?>:</b></div>
          <div class="panel-body">
            <p> <span class="label label-<?php echo $model->state->class_status?>"> <i class="fa <?php echo $model->state->icon_class?>"></i> <?php echo $model->state->description;?></span> </p>
          </div>
         
         <?php if(!$this->module->justRequest):?>
         <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('datetime_go_pay')); ?>:</b></div>
          <div class="panel-body">
              <?php echo date('d.m.Y H:i a',strtotime($model->datetime_go_pay));?>
            <span class="text-muted">
              <?php echo Yii::app()->format->formatAgoComment($model->datetime_go_pay);?>
            </span>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('datetime_return_pay')); ?>:</b></div>
          <div class="panel-body">
            <?php if(!empty($model->datetime_return_pay)):?>
              <?php echo date('d.m.Y H:i a',strtotime($model->datetime_return_pay));?>
            <span class="text-muted">
              <?php echo Yii::app()->format->formatAgoComment($model->datetime_return_pay);?>
            </span>
            <?php else:?>
              <em>Sin respuesta aún</em>
            <?php endif;?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('message_return_pay')); ?>:</b></div>
          <div class="panel-body">
            <?php echo Yii::app()->format->toBr($model->message_return_pay);?>
          </div>

          <div class="panel-heading"><b><?php echo CHtml::encode($model->getAttributeLabel('code_response_pay')); ?>:</b></div>
          <div class="panel-body">
            <p><?php echo $model->code_response_pay;?></p>
          </div>
         <?php endif;?>

        </div>
    </div>
</div>

    <div class="form-group">
        <div class="text-right">
        <?php echo CHtml::link(Yii::t('app','Back'),array('admin'),array('class'=>'btn btn-large btn-default'))?>        </div>
    </div>
        </div>
    </div>
</section>
</div>