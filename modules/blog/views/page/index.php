    <section class="breadcrumb-wrapper">
        <div class="container">
            <h2>Blog</h2>
            <ol class="breadcrumb">
                <li><a href="<?=$this->createUrl("/")?>">Home</a></li>
                <li class="active">Blog</li>
            </ol>
        </div>
    </section>
    <!-- ==========================
        BREADCRUMB - END 
    =========================== -->

    <!-- ==========================
        BLOG - START 
    =========================== -->
    <section class="content bg-color-2" id="blog">
        <div class="container">
            <div class="row">
                <!-- BLOG CONTENT - START -->
                <div class="col-md-12 blog-content">
                    
                    
                    <?php foreach($posts as $data):?>    
                    <!-- BLOG POST -->
                    <div class="blog-post">
                        <?php if(!empty($data->youtube) or !empty($data->vimeo)):?>
                            <div class="flex-video widescreen">
                        <?php else:?>
                            <div class="">
                        <?php endif;?>
                           
                           <?php if(!empty($data->image)):?>
                               <img src="<?=$data->image_path?>" class="img-responsive" alt="">
                           <?php elseif(!empty($data->youtube)):?>
                           <?php 
                            $youtubeID=strtr($data->youtube,array(
                                'http://www.youtube.com/watch?v='=>'',
                                'https://www.youtube.com/watch?v='=>'',
                            ));
                           ?>
                               <iframe allowfullscreen src="http://www.youtube.com/embed/<?=$youtubeID?>?feature=player_detailpage"></iframe>
                           <?php elseif(!empty($data->vimeo)):?>
                           <?php 
                            $vimeoID=strtr($data->vimeo,array(
                                'http://vimeo.com/'=>'',
                                'https://vimeo.com/'=>'',
                                'http://www.vimeo.com/'=>'',
                                'https://www.vimeo.com/'=>'',
                            ));
                           ?>
                               <iframe src="https://player.vimeo.com/video/<?=$vimeoID?>"></iframe>                         
                           <?php endif;?>
                        </div>
                        <div class="blog-post-detail">
                            <span><i class="fa fa-calendar"></i><?=date("d/m/Y",strtotime($data->created_at))?></span>
                            <span><i class="fa fa-user"></i><?=$data->author->name?></span>
                            <!-- <span class="text-light hidden-xs"><a href="#">E-commerce</a>, <a href="#">Business</a>, <a href="#">Technology</a></span> -->
                        </div>
                        <div class="blog-post-body">
                            <a href="blog-post2.html"><h3><?=$data->title?></h3></a>
                            <p><?=strip_tags(substr($data->text, 0,250))."..."?></p>
                            <a href="<?=$this->createUrl("detail",array("id"=>$data->id))?>" class="btn btn-primary"><i class="fa fa-chevron-right"></i>Read More</a>
                        </div>
                    </div>
                    <?php endforeach;?>    
                    
                    
                    
                    <!-- PAGINATION - 
                    <ul class="pagination">
                        <li class="disabled"><a><i class="fa fa-chevron-left"></i></a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>            
                    START -->
                    <!-- PAGINATION - END -->
                </div>
                <!-- BLOG CONTENT - END -->
            </div>
            
        </div>
    </section>
