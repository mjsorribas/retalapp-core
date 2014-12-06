<section class="content" id="pricing">
    	<div class="container">
        	<h2>Pricing 1</h2>
            <div class="row">
            	
                <!-- Pricing plan -->
                <?php foreach($model as $i => $data):?>
                <div class="col-sm-4">
                    <div class="pricing-plan<?php echo ($i===1)?' popular':'';?>">
                        <h3><?=$data->name?></h3>
                        <?php if(!empty($data->subtitle)):?>
                            <p><?=$data->subtitle?></p>
                        <?php endif;?>
                        <div class="pricing-plan-price">
                            <span class="pricing-plan-small">$</span>
                            <span class="pricing-plan-number"><?=$data->price?></span>
                            <!-- <span class="pricing-plan-small">.99</span> -->
                            <span class="pricing-plan-text"><?=$data->pay_per?></span>
                        </div>
                        <ul class="list-unstyled">
                            <?php foreach($data->features as $f):?>
                                <li><i class="fa <?=$f->icon?>"></i><?=$f->name?></li>
                            <?php endforeach;?>
                        </ul>
                        <a href="<?=$this->createUrl("/contact/page/index",array("subject"=>"More info: ".$data->name))?>" class="btn btn-lg btn-primary">Contac us</a>
                    </div>
                </div>
                <?php endforeach;?>
                
                
            </div>
        </div>
    </section>