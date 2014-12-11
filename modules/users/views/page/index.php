<?php
/* @var $this SiteController */
/* @var $user LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('app','Profile');
?>

<section>
    <div class="container">
        <div class="row">
            
            <div class="col-md-3">
                <img class="img-thumbnail" src="<?=$model->imageUrl?>" alt="">

                <?=$model->email?><br>
            </div>
            <div class="col-md-9">
                <h1><?=$model->name?> <?=$model->lastname?></h1>
                <a href="<?=$this->createUrl("perfil")?>">Editar perfil</a>
                <div role="tabpanel">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Novedades (1)</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Mis periódicos</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Suscriptores</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Mis suscripciones</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">

                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">

                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">

<?php $this->renderPartial('../followers/view_embed',array(

    'model'=>$model,
    'followersDataProvider'=>$followersDataProvider,
    'followers'=>$followers,
))?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings">

<?php $this->renderPartial('../following/view_embed',array(

    'model'=>$model,
    'followingDataProvider'=>$followingDataProvider,
    'following'=>$following,
))?>
                    </div>
                  </div>

                </div>
            
            </div>
  
        </div>
    </div>
</section>
