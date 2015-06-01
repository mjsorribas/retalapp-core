<?php $slider=LandingElementsSlider::model()->findAll(array('order'=>'orden_id'));?>
<header>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php foreach($slider as $id => $data):?>
      <li data-target="#carousel-example-generic" data-slide-to="<?=$id?>"<?php echo ($id==0)?' class="active"':'';?>></li>
    <?php endforeach;?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <?php foreach($slider as $id => $data):?>
    <div class="item<?php echo ($id==0)?" active":"";?>">
      <!--
        <img src="<?=$data->image_path?>" alt="...">
      -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><?=$data->title?></h2>
               
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <p><?=$data->text?></p>
            </div>
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <a target="_blank" href="<?=$data->link?>" class="btn btn-lg btn-outline">
                    <i class="fa fa-download"></i> Download Theme
                </a>
            </div>
        </div>
    </div>
    </div>
    <?php endforeach;?>    
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
</header>