<?php
/* @var $this BackController */

$this->breadcrumbs=array(
	$this->module->id,
);
$itemSelected=null;
if($id!==null and ($model=ShoppingItems::model()->findByPk($id))!==null) {
	$this->fb_title=$model->name;
	$this->fb_type='website';
	$this->fb_url=$this->createAbsoluteUrl('/shopping/page/index',array('id'=>$model->id,'slug'=>$model->slug));
	if($model->images!==array())
		$this->fb_image=$model->images[0]->image_path;
	$this->fb_site_name=r()->name;
	$this->fb_description=$model->description_detail;
	$itemSelected=$model;
} else {
	$this->fb_image=$shopping_info->image_path;
	$this->fb_type='website';
	$this->fb_url=$this->createAbsoluteUrl('/');
	$this->fb_site_name=r()->name;
	$this->fb_description=$this->metaDescription;
	$this->fb_title=$this->metaTitle;
}
$this->itemSelected=$itemSelected;

?>
<div class="no-padding top-content" style="background-image: url(<?=$shopping_info->image_path;?>)">
  <div class="w100 top-content-bg">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="parallax-content clearfix animated fadeInDown top-parallax-content">
            <h5 class="parallaxSubtitle">
              <em><?=r()->format->toBr($shopping_info->description);?></em>
            </h5>
            <h1 class="x2large top-question">
              <?=$shopping_info->title;?>
            </h1>
            <?php foreach($shopping_categories as $data): ?>
              <a href="#<?=$data->slug;?>" style=" text-transform: uppercase;" class="scrollTo btn btn-primary btn-lg top-link-category"><?=$data->name;?></a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="home-white-section">
  
<div class="container"> 

<div class="row animated">
    
    <?php foreach($shopping_features as $data): ?>
    <div class="col-lg-4 text-center col-md-4 col-sm-6 col-sm-6">
      <div class="features-content">
      <img src="<?=$data->image_path;?>" class="img-rounded" alt="">
      </div>
      <h3 class="block-title-3">
        <?=$data->title;?>
      </h3>
      <p style="color:#7F8C8D;  font-size: 17px;  font-weight: 300;font-size: 16px;"><?=r()->format->toBr($data->description);?></p>
    </div>
    <?php endforeach; ?>

  </div>
</div>
</section>

<div class="container main-container" style="margin-top: 35px"> 
  
<?php foreach($shopping_categories as $data): ?>
<div id="<?=$data->slug;?>" class="morePost row featuredPostContainer style2">
    <h3 class="section-title style2 text-center"><span><?=$data->name;?></span></h3>
    <div class="container">
      <div class="row xsResponse">
        
		<?php foreach($data->items as $item): ?>
		<?php $url = $this->createAbsoluteUrl('/shopping/page/index',array('id'=>$item->id,'slug'=>$item->slug));?>
        <div class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
          <div class="product">
            <div class="image">  
	          	<!-- <div class="quickview">
	            	<a title="Ver más" class="btn btn-xs  btn-quickview" data-target="#product-details-modal-<?=$item->id?>" data-toggle="modal"> Ver más </a>
	            </div> -->

             	<?php if($item->images!==array()):?>
             	<a data-target="#product-details-modal-<?=$item->id?>" data-toggle="modal" href="#">
             		<img src="<?=$item->images[0]->image_path?>" alt="img" class="img-responsive">
         		</a>
             	<?php endif;?>

            	<div class="promotion">  <!-- <span class="discount">15% DESC</span> --> </div>
            </div>
            <div class="description">
              <h4><a data-target="#product-details-modal-<?=$item->id?>" data-toggle="modal" href="#"><?=strtoupper($item->name);?></a></h4>
              <p><?=r()->format->toBr($item->description);?></p>
            </div>
            <div class="price"> 
            	<span>$<?=r()->format->money($item->price);?></span>
          	</div>

            <div class="action-control"> 
            	<a data-target="#product-details-modal-<?=$item->id?>" data-toggle="modal" class="btn btn-primary btn-gift"> <span class="add2cart"> <!-- <i class="glyphicon glyphicon-shopping-cart"> </i> --> Ver mas </span> </a> 
            </div>
          
          </div>
        </div>


		<div class="modal fade product-details-modal" id="product-details-modal-<?=$item->id?>" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <button aria-hidden="true" data-dismiss="modal" class="close" type="button"> × </button>
		            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding:0">

		                <div class="main-image  col-lg-12 no-padding style3">
		                    <?php if($item->images!==array()):?>
		                    <a class="product-largeimg-link" href="#">
		                    	<img src="<?=$item->images[0]->image_path?>" class="img-responsive product-largeimg" alt="img">
		                    </a>
			             	<?php endif;?>
		                </div>
		                
		                <div class="modal-product-thumb">
		                    <?php if($item->images!==array()):?>
		                    <?php foreach($item->images as $image):?>
		                    <a class="thumbLink selected">
		                    	<img data-large="<?=$image->image_path?>" alt="img" class="img-responsive" src="<?=$image->image_path?>">
		                    </a>
			             	<?php endforeach;?>
			             	<?php endif;?>
		                </div>
		            </div>
		           
		            
		            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 modal-details no-padding">
		                <div class="modal-details-inner">
		                    <h1 class="product-title"><?=$item->name?></h1>
		                    <div class="product-price"> <span class="price-sales">$<?=r()->format->money($item->price);?></span> 

		                    </div>
		                    <div class="details-description">
		                    	<p><?=r()->format->toBr($item->description_detail);?></p>
		                    </div>
		                    
		                    <br>
		                    <div class="cart-actions">
		                        <div class="addto">
		                            <button data-id="<?=$item->id?>" data-modal="#product-details-modal-<?=$item->id?>" class="button btn-cart btn-cart-add-to-cart cart first" title="Agregar a mi compra" type="button">Comprar este regalo</button>
		                            <!-- <a class="link-wishlist wishlist">Add to Wishlist</a>  -->
	                            </div>
		                    </div>

		                    <div class="product-share clearfix">
		                        <p> Compartelo en: </p>
		                        <!-- @TODO &via=detallesysorpresasalgoespecial -->
								<div class="socialIcon">
								    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url?>" target="_blank"> <i class="fa fa-facebook"></i></a>
		                            <a href="https://twitter.com/share?url=<?php echo $url?>&text=<?php echo "Me gusta ".$item->name?>" target="_blank"> <i class="fa fa-twitter"></i></a>
		                            <a href="whatsapp://send?text=<?=$item->name?> - <?=($item->description_detail);?> <?php echo $url?>" data-href="<?php echo $url?>" data-img="<?php echo $item->images[0]->image_path?>" data-action="share/whatsapp/share" class="hidden-sm hidden-md hidden-lg"> <i class="fa fa-whatsapp"></i></a>
		                            <!-- <a href="#"> <i class="fa fa-google-plus"></i></a>
		                            <a href="#"> <i class="fa fa-pinterest"></i></a> -->
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="clear"></div>
		        </div>
		    </div>
		</div>
		<?php endforeach; ?>

      </div>
    </div>
  </div>
<?php endforeach; ?>
          
 </div>
</div>
