<section class="jumbotron2">
	<div class="container">
        <h2><?=$contact->title?> <small><?=$contact->subtitle?></small></h2>
    </div>
</section>

<section class="content" id="contact">
	<div class="container">
        <div class="row">

            <div style="margin: 20px 0" id="google-map">
                <div style="height: 25rem" id="map-canvas"></div>
            </div>

        	<div class="col-sm-6">
                <form action="#" id="contact-form">
                    
                        <div class="row">
                            <div class="form-group col-sm-12">
                                
                                <input type="text" class="form-control " placeholder="Nombre" id="name" name="name">
                            </div>                               
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12">
                                
                                <input type="text" class="form-control " placeholder="Email" id="email" name="email">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12">
                                
                                <input type="text" class="form-control " placeholder="Contacto" id="phone" name="phone">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-sm-12">
                                
                                <?php
                                    if(isset($_GET['subject'])) {
                                        $content=$_GET['subject'];
                                    } else {
                                        $content='';
                                    }
                                ?>
                                <textarea style="height: 150px" class="form-control" placeholder="Mensaje" id="message" name="message"><?=$content?></textarea>
                                
                                <button style="margin-top: 20px" type="submit" class="btn btn-primary pull-right"><i class="fa fa-paper-plane"></i> Enviar</button>
                                
                            </div>
                        </div>
                    
                </form>
            </div>
            <div class="col-sm-6">
                <p><?=r()->format->toBr($contact->contact_text)?></p>
            	<ul class="list-unstyled contact-address">
                	<li><i class="fa fa-map-marker"></i> <?=$contact->address?></li>
                    <li><i class="fa fa-envelope"></i> <a href="emailto:<?=$contact->email?>"><?=$contact->email?></a></li>
                    <li><i class="fa fa-mobile"></i> <a href="callto://<?=$contact->phone?>"><?=$contact->phone?></a></li>
                </ul>
                <ul class="brands brands-md brands-inline brands-transition brands-circle main">
                    <?php if(!empty($contact->facebook)):?>
                    <li><a href="<?=$contact->facebook?>"><i class="fa fa-facebook"></i></a></li>
                	<?php endif;?>
                    <?php if(!empty($contact->twitter)):?>
                    <li><a href="<?=$contact->twitter?>"><i class="fa fa-twitter"></i></a></li>
                    <?php endif;?>
                    <?php if(!empty($contact->google_plus)):?>
                    <li><a href="<?=$contact->google_plus?>"><i class="fa fa-google-plus"></i></a></li>
                    <?php endif;?>
                    <?php if(!empty($contact->linked_in)):?>
                    <li><a href="<?=$contact->linked_in?>"><i class="fa fa-linkedin"></i></a></li>
                    <?php endif;?>
                    <?php if(!empty($contact->youtube)):?>
                    <li><a href="<?=$contact->youtube?>"><i class="fa fa-youtube"></i></a></li>
                    <?php endif;?>
                    <?php if(!empty($contact->skype)):?>
                    <li><a href="skype:<?=$contact->skype?>?call"><i class="fa fa-skype"></i></a></li>
                    <?php endif;?>
                </ul>
            </div>
        </div>            
    </div>
</section> 