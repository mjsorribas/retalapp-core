<section id="team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Team</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
        <?php foreach(TeamItems::model()->findAll(array('order'=>'orden_id')) as $data):?>
            <div class="col-sm-3">
                
                <img src="<?=$data->image_path?>" class="img-responsive" alt="">
                <div class="caption">
                    <div class="caption-content">
                        <h1><?=$data->name?></h1>
                        <h2><?=$data->position?></h2>
                        <p><?=$data->description?></p>
                    </div>
                </div>
                
            </div>
        <?php endforeach;?>
        </div>
    </div>
</section>