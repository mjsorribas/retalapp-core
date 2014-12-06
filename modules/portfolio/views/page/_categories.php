<?php $text=PortfolioText::model()->find();?>
<?php $half=strlen($text->text)/2;?>
<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Services</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
       			<p><?php echo r()->format->toBr(substr($text->text,0,$half))?></p>
            </div>
            <div class="col-sm-6">
       			<p><?php echo r()->format->toBr(substr($text->text,$half))?></p>
            </div>
        </div>
        <?php foreach(PortfolioCategories::model()->findAll(array('order'=>'orden_id')) as $i => $data):?>
        <div class="row">
            <?php if($i%2==0):?>
            <div class="col-sm-6">
                <img src="<?=$data->image_path?>" class="img-responsive" alt="">
            </div>
            <div class="col-sm-6">
            	<h2><?=$data->name?></h2>    
            	<p><?=$data->description?></p>    
            </div>
            <?php else:?>
            <div class="col-sm-6">
            	<h2><?=$data->name?></h2>    
            	<p><?=$data->description?></p>    
            </div>
            <div class="col-sm-6">
                <img src="<?=$data->image_path?>" class="img-responsive" alt="">
            </div>
            <?php endif;?>
        </div>
        <?php endforeach;?>
    </div>
</section>