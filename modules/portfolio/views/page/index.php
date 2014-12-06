<?php foreach(PortfolioCategories::model()->findAll(array('order'=>'orden_id')) as $category):?>
<section id="portfolio-<?=$category->id?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2><?=$category->name?></h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
        <?php foreach(PortfolioItems::model()->findAll(array('condition'=>'portfolio_categories_id='.$category->id,'order'=>'orden_id','limit'=>8)) as $data):?>
            <div class="col-sm-3 portfolio-item" style="height:250px">
                <a href="<?php echo $this->createUrl("index")?>#portfolio-<?=$data->id?>">
                    <img src="<?=$data->preview_path?>" class="img-responsive" alt="">
                </a>
            </div>
        <?php endforeach;?>
        </div>
    </div>
</section>
<?php endforeach;?>