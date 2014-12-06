<section class="content bg-color-2" id="eshop">
    	<div class="container">
        	<div class="row eshop-main eshop-list">
            	<!-- ESHOP CONTENT - START -->
                <div class="col-md-12 eshop-content">
                	
                    <!-- ESHOP PRODUCT -->
                    <?php foreach($model as $i => $data):?>
                    <div class="eshop-product">
                        <div class="row">
                            <?php if($i%2==0):?>
                            <div class="col-lg-6">
                                <img src="<?=$data->image_path?>" class="img-responsive" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="eshop-product-body">
                                    
                                    <h3><a href="#"><?=$data->title?></a></h3>
                                    <p><?=r()->format->toBr($data->text)?></p>
                                    
                                </div>
                            </div>
                            <?php else:?>
                            <div class="col-lg-6">
                                <div class="eshop-product-body">
                                    
                                    <h3><a href="#"><?=$data->title?></a></h3>
                                    <p><?=r()->format->toBr($data->text)?></p>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img src="<?=$data->image_path?>" class="img-responsive" alt="">
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php endforeach;?>
                        
                </div>
             
            </div>
        </div>
    </section>