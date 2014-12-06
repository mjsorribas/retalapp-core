<?php $model=HowWorkText::model()->find()?>
<?php $items=HowWorkItems::model()->findAll(array('order'=>'orden_id'))?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><?=$model->title?></h2>
                <hr class="star-primary">
                <p><?=r()->format->toBr($model->text)?></p>
            </div>
        </div>
        <div class="row">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php foreach($items as $data):?>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading-<?=$data->id?>">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?=$data->id?>" aria-expanded="false" aria-controls="collapse-<?=$data->id?>">
                      <?=$data->label?>
                    </a>
                  </h4>
                </div>
                <div id="collapse-<?=$data->id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?=$data->id?>">
                  <div class="panel-body"><?=r()->format->toBr($data->text)?></div>
                </div>
              </div>
        <?php endforeach;?>
            </div>
        </div>
    </div>
</section>