<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Portfolio</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
        <?php foreach(PortfolioItems::model()->findAll(array('order'=>'orden_id','limit'=>8)) as $data):?>
            <div class="col-sm-3 portfolio-item" style="height:250px">
                <a href="<?php echo $this->createUrl("/portfolio/page/index")?>#portfolio-<?=$data->id?>" class="portfolio-link">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="<?=$data->preview_path?>" class="img-responsive" alt="">
                </a>
            </div>
        <?php endforeach;?>
        </div>
    </div>
</section>