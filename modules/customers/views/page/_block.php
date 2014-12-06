<section id="customers">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Customers</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
        <?php foreach(CustomersItems::model()->findAll(array('order'=>'orden_id')) as $data):?>
            <div class="col-sm-3">
                
                <img src="<?=$data->image_path?>" class="img-responsive" alt="">
                
            </div>
        <?php endforeach;?>
        </div>
    </div>
</section>