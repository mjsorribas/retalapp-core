<section style="padding-top:130px;padding-bottom: 0;" id="products" class="gray-bg padding-top-bottom">

	<div class="container products-detail">
		
		<h1 class="section-title products-detail-header"><?=$model->name?></h1>
		
		<div class="row">
		
			<div class="col-md-6">
			<?php if($vid!==null):?>
			<div class="products-detail-video">

				<?php if(!empty($vid->link_vimeo)):?>
				<iframe src="https://player.vimeo.com/video/<?=strtr($vid->link_vimeo,array(
					'https://vimeo.com/'=>'',
					'http://vimeo.com/'=>'',
					'https://www.vimeo.com/'=>'',
					'http://www.vimeo.com/'=>'',
				))?>" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

				<div class="products-detail-video-info">
					<h2><div class="col-md-8"><?=$vid->titulo?></div><div class="text-right col-md-4 prn pln"><span id="view-message"><?=$vid->estaVistoHtml();?></span> <a data-toggle="tooltip" data-placement="right" title="Marcar como visto" data-id="<?=$vid->id?>" class="action-view" href="#"><i class="fa fa-eye"></i></a></div> </h2>
					<p><?=$vid->descripcion?></p>
				</div>
				<?php elseif(!empty($vid->link)):?>
				
					<a target="_blank" href="<?=$vid->link?>">
						<div class="icon-link-video"><i class="fa fa-download"></i></div>
					</a>

				<div class="products-detail-video-info">
					<h2><div class="col-md-8"><?=$vid->titulo?></div><div class="text-right col-md-4 prn pln"><span id="view-message"><?=$vid->estaVistoHtml();?></span> <a data-toggle="tooltip" data-placement="right" title="Marcar como visto" data-id="<?=$vid->id?>" class="action-view" href="#"><i class="fa fa-eye"></i></a></div> </h2>
					<p><?=$vid->descripcion?></p>
				</div>
				<?php endif;?>
			</div>
			<?php endif;?>
			</div>
			<div class="products-detail-right col-md-6">
			<?php foreach($model->videos as $video):?><?php
			if(!empty($video->link_vimeo)):
				$videoID=strtr($video->link_vimeo,array(
					'http://vimeo.com/'=>'',
					'https://vimeo.com/'=>'',
					'http://www.vimeo.com/'=>'',
					'https://www.vimeo.com/'=>'',
				));
				$hash = unserialize(@file_get_contents("http://vimeo.com/api/v2/video/{$videoID}.php")); ?>
				<div style="cursor: pointer;" class="media action-url" data-url="<?=$this->createUrl('viewUser',array('id'=>$model->id,'slug'=>$model->slug,'v'=>$video->id))?>">
				  <div class="media-left pull-left media-top">
				    <img class="media-object" src="<?=$hash[0]['thumbnail_small']?>" alt="...">
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading"><?=$video->titulo?></h4>
				    <p><?=$video->descripcion?></p>
					<span id="view-message-<?=$video->id?>"><?=$video->estaVistoHtml();?></span>
				  </div>
				</div>
			<?php elseif(!empty($video->link)):?>
			<div style="cursor: pointer;" class="media action-url" data-url="<?=$this->createUrl('viewUser',array('id'=>$model->id,'slug'=>$model->slug,'v'=>$video->id))?>">
			  <div class="media-left pull-left media-top">
			      <div class="icon-link-front"><i class="fa fa-download"></i></div>
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading"><?=$video->titulo?></h4>
			    <p><?=$video->descripcion?></p>
				<span id="view-message-<?=$video->id?>"><?=$video->estaVistoHtml();?></span>
			  </div>
			</div>
			<?php endif;?>
			<?php endforeach;?>
			</div>
		</div>
	</div>
</section>
<!-- ==============================================
TESTIMONIALS
=============================================== -->
<section id="testimonials" class="white-bg padding-top-bottom">
	<div class="container testimonials">
		
		<h1 class="section-title">Facilitador</h1>

	  	<div class="row">
			<div class="col-lg-12">
				<div class="testimonials-items">
				<div class="testimonials-img">
					<img src="<?=$model->facilitador->imagen_path?>" alt="">
				</div>

					<h2><?=$model->facilitador->nombre?></h2>
					<hr>
					<p class="blockquote"><?=$model->facilitador->perfil?></p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
if($vid!==null) {
r()->clientScript->registerScript('action-view',"
	$(function(){
		$(document).on('click','.action-view',function(e){
			e.preventDefault();
			$('#view-message').load('".$this->createUrl('viewVideo',array('id'=>$vid->id))."',function(response){
				$('#view-message-".$vid->id."').html(response);
			});
		});	
		setTimeout(function(){
			$('#view-message').load('".$this->createUrl('viewVideo',array('id'=>$vid->id))."',function(response){
				$('#view-message-".$vid->id."').html(response);
			});
		},5000);
	})
");
}
?>