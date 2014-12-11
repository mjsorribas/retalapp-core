<?php
/* @var $this SiteController */
/* @var $user LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('app','Profile');
?>
<link rel="stylesheet" href="<?php echo $this->themeUrl()?>/assets/css/perfil.css">
<div id="main">
  <div class="main-bootom">

  <div class="tab-red">
      <div class="arrow_down"></div>
  <!--Perfil Fijo-->
      <div class="perfil-fijo">
       <div class="caja-moviente">
        <div class="img-perfil">
          
          <img src="<?=$model->imageUrl?>" alt="">
        </div>
          <div class="clear"></div>
        <div class="datos-left1">
          <div class="titulo-perfil">
            <a class="ver-perfil-izq">
              <i class="icon-cogs"></i> 
              <h2>Gustavo Salgado<br><span>Ver mi pagína de perfil</span></h2>
            </a>
          </div>
        </div>  
          <div class="clear"></div>
        <div class="datos-left">
          

        </div>
          <div class="clear"></div>
      </div><!--Fin Caja Moviente-->
     </div>  
  <!--Fin Perfil Fijo-->

  <h1><?=$model->name?> <?=$model->lastname?></h1>
  <a href="<?=$this->createUrl("profile")?>">Editar perfil</a>
  
  <a href="#" id="popover-notifications" 
  tabindex="0" 
  class="" 
  role="button" 
  data-toggle="popover" 
  data-content="
    <?php foreach($model->notifications as $data):?>
    <a href='<?=$data->url?>'><?=$data->message?></a> 
    <hr>
    <?php endforeach;?>
  " 
  data-html="true">Notificaciones <span class="badge"><?=$model->countNotificacionsUnread?></span></a>
    
  <br>

  <div role="tabpanel" style="width: 800px;float: right;margin-top: 30px;">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#feed" aria-controls="feed" role="tab" data-toggle="tab">Novedades</a></li>
      <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Mis periódicos</a></li>
      <li role="presentation"><a href="#followers" aria-controls="followers" role="tab" data-toggle="tab">Suscriptores <span class="badge"><?=$model->countFollowers?></span></a></li>
      <li role="presentation"><a href="#following" aria-controls="following" role="tab" data-toggle="tab">Mis suscripciones <span class="badge"><?=$model->countFollowings?></span></a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="feed">

      </div>
      <div role="tabpanel" class="tab-pane" id="profile">

      </div>
      <div role="tabpanel" class="tab-pane" id="followers">

<?php $this->renderPartial('../followers/view_embed',array(

    'model'=>$model,
    'followersDataProvider'=>$followersDataProvider,
    'followers'=>$followers,
))?>
  </div>
  <div role="tabpanel" class="tab-pane" id="following">

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


<script>
$(function(){
  $('#popover-notifications').popover();
})
</script>
