<?php
/* @var $this BackController */
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div class="jumbotron jumbotron6">  
        <div id="jumbotron-slider" class="owl-carousel hidden-control owl-theme">       
            
            <?php foreach($slider as $i => $data):?>
                <div class="item" id="slide-1" style="background-image: url(<?=$data->image_path?>)">
                <div class="container">
                    <div class="row">
                        <?php if($i%2==0):?>
                            <div class="col-md-6">
                                <img src="<?=$data->image_front_path?>" class="img-responsive hidden-xs hidden-sm" alt="">
                            </div>
                            <div class="col-md-6">
                                <?php if(!empty($data->text1)):?>
                                <h2><?=$data->text1?></h2>
                                <?php endif;?>
                                <?php if(!empty($data->text2)):?>
                                <h3><?=$data->text2?></h3>
                                <?php endif;?>
                                <?php if(!empty($data->text3)):?>
                                <h3><?=$data->text3?></h3>
                                <?php endif;?>
                                <?php if(!empty($data->text4)):?>
                                <h3><?=$data->text4?></h3>
                                <?php endif;?>
                            </div>
                        <?php else:?>
                            <div class="col-md-6">
                                <?php if(!empty($data->text1)):?>
                                <h2><?=$data->text1?></h2>
                                <?php endif;?>
                                <?php if(!empty($data->text2)):?>
                                <h3><?=$data->text2?></h3>
                                <?php endif;?>
                                <?php if(!empty($data->text3)):?>
                                <h3><?=$data->text3?></h3>
                                <?php endif;?>
                                <?php if(!empty($data->text4)):?>
                                <h3><?=$data->text4?></h3>
                                <?php endif;?>
                            </div>

                            <div class="col-md-6">
                                <img src="<?=$data->image_front_path?>" class="img-responsive hidden-xs hidden-sm" alt="">
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            
        </div>
    </div>


    <section class="content" id="section-introduction">
        <div class="container">
            <h2><?=$intro->title?></h2>
            <p><?=r()->format->toBr($intro->text)?></p>
        </div>
    </section>
    
    <section class="content bg-color-2" id="section-features">
        <div class="container">
            <div class="row">
                <?php foreach($items as $data):?>
                <div class="col-sm-6 col-md-3">
                    <div class="feature">
                        <i class="fa <?=$data->icon?>"></i>
                        <h3><?=$data->title?></h3>
                        <p><?=r()->format->toBr($data->text)?></p>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    
    <!-- ==========================
        RECENT BLOG POSTS - START 
    =========================== -->
    <section class="content" id="section-blog-posts">
        <div class="container">
            <h2 class="text-center">Recent Blog Post</h2>
            <div class="row">
                
                <?php foreach($recent as $data):?>
                <div class="col-sm-6">
                    <div class="recent-blog-post">
                        <div class="post-date"><?=date("d/m/Y",strtotime($data->post->created_at))?></div>
                        <h3><?=$data->post->title?></h3>
                        <p><?=strip_tags(substr($data->post->text, 0,150))."..."?></p>
                        <a href="<?=$this->createUrl("/blog/page/detail",array("id"=>$data->post->id))?>">Read More<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <?php endforeach;?>
                
            </div>
            
            <div class="text-center"><a href="<?=$this->createUrl("/blog")?>" class="btn btn-inverse btn-lg"><i class="fa fa-arrow-circle-down"></i>See more Posts</a></div>
        </div>
    </section>
    <!-- ==========================
        RECENT BLOG POSTS - END 
    =========================== -->
    
    <!-- ==========================
        LATEST WORK - START 
    =========================== -->
    <section class="content bg-color-2" id="section-portfolio">
        <div class="container">
            <h2>Check our Latest work</h2>
            <div class="row">
                <?php foreach($work as $data):?>
                <div class="col-md-4">
                    <article class="portfolio-item">
                        <img src="<?=$data->image_path?>" class="img-responsive" alt="">
                        <div class="hover-overlay">
                            <p><?=r()->format->toBr($data->description)?></p>
                            <a href="<?=$data->image_path?>" class="show-image"><i class="fa fa-plus"></i></a>
                            <a href="portfolio-post1.html"><i class="fa fa-link"></i></a>
                        </div>
                    </article>
                    <div class="portfolio-item-description">
                        <h3><?=$data->name?></h3>
                    </div>
                </div>
                <?php endforeach;?>
                
                
            </div>
        </div>
    </section>
    <!-- ==========================
        LATEST WORK - END 
    =========================== -->
    
    <!-- ==========================
        PARTNERS - START 
    =========================== -->
    <section class="content" id="section-partners">
        <div class="container">
            <h2 class="text-center">Clients</h2>
            <p class="secondary-headline text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec lorem quis est ultrices volutpat.</p>
            <div id="partners-slider">       
                <?php foreach($clients as $data):?>
                <div class="item"><a href="#"><img src="<?=$data->image_path?>" alt="" id="partner_<?=$data->id?>"></a></div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    

<script>
$(function(){
    //PARTNER BRANDS

<?php foreach($clients as $data):?>
    $('#partner_<?=$data->id?>').mouseenter(function() {$(this).attr("src","<?=$data->image_hover_path?>");});
    $('#partner_<?=$data->id?>').mouseleave(function() {$(this).attr("src","<?=$data->image_hover_path?>");});
<?php endforeach;?>
    
})
</script>
