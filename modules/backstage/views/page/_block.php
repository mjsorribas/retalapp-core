<section id="backstage">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Backstage</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
        <?php foreach(LocationItems::model()->findAll(array('order'=>'orden_id')) as $data):?>
            <div class="col-sm-4">
                
                <img src="<?=$data->image_path?>" class="img-responsive" alt="">
                
            </div>
        <?php endforeach;?>
        </div>
    </div>
</section>