    <section class="breadcrumb-wrapper">
        <div class="container">
            <h2>Blog</h2>
            <ol class="breadcrumb">
                <li><a href="<?=$this->createUrl("/")?>">Home</a></li>
                <li class="active">Blog</li>
                <li class="active"><?=$model->title?></li>
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
                                    
                    <!-- BLOG POST -->
                    <div class="blog-post">
                        <?php if(!empty($model->youtube) or !empty($model->vimeo)):?>
                            <div class="flex-video widescreen">
                        <?php else:?>
                            <div class="">
                        <?php endif;?>
                           
                           <?php if(!empty($model->image)):?>
                               <img src="<?=$model->image_path?>" class="img-responsive" alt="">
                           <?php elseif(!empty($model->youtube)):?>
                           <?php 
                            $youtubeID=strtr($model->youtube,array(
                                'http://www.youtube.com/watch?v='=>'',
                                'https://www.youtube.com/watch?v='=>'',
                            ));
                           ?>
                               <iframe allowfullscreen src="http://www.youtube.com/embed/<?=$youtubeID?>?feature=player_detailpage"></iframe>
                           <?php elseif(!empty($model->vimeo)):?>
                           <?php 
                            $vimeoID=strtr($model->vimeo,array(
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
                            <span><i class="fa fa-calendar"></i><?=date("d/m/Y",strtotime($model->created_at))?></span>
                            <!-- <span><i class="fa fa-comment"></i>11</span> -->
                            <!-- <span class="text-light hidden-xs"><a href="#">E-commerce</a>, <a href="#">Business</a>, <a href="#">Technology</a></span> -->
                        </div>
                        <div class="blog-post-body">
                            <h3><?=$model->title?></h3>
                            <?=$model->text?>
                        </div>
                    </div>
                    
                    <!-- AUTHOR - START -->
                    <div class="about-author">
                        <div class="media">
                            <div class="pull-left">
                                <a href="#"><img class="media-object" src="<?=$model->author->image_path?>" alt=""></a>
                                <!-- <ul class="brands brands-sm brands-circle brands-inline text-center main">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                </ul> -->
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><?=$model->author->name?></h4>
                                <p><?=r()->format->toBr($model->author->description)?></p>
                                <!-- <ul class="list-unstyled list-inline">
                                    <li><a href=""><i class="fa fa-envelope"></i>johndoe@website.com</a></li>
                                    <li><a href=""><i class="fa fa-globe"></i>www.johndoe.com</a></li>
                                    <li><a href=""><i class="fa fa-file-text-o"></i><b>23</b> Posts</a></li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                    
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'pagejulius'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    
                </div>
                <!-- BLOG CONTENT - END -->
            </div>
            
        </div>
    </section>
