<?php if($videos_videos!==array()):?>
<!-- ==============================================
VIDEOS
=============================================== -->
<section style="padding-top:130px;padding-bottom: 0;" id="videos" class="white-bg padding-top-bottom">

	<div class="">
		
		<h1 class="section-title scrollimation fade-left d2">Videos</h1>
		<div class="row">

<div class="sliderContainer visibleNearby fullWidth clearfix royalSlider-preview">
<div id="gallery-1" class="royalSlider rsDefault">
<?php foreach($videos_videos as $data): 
$video=strtr($data->video,array(
	'http://vimeo.com/'=>'',
	'http://www.vimeo.com/'=>'',
	'https://vimeo.com/'=>'',
	'https://wwwvimeo.com/'=>'',
));
$hash = unserialize(@file_get_contents("http://vimeo.com/api/v2/video/{$video}.php"));
?>
<a class="rsImg" href="<?=$hash[0]['thumbnail_large']?>" data-rsVideo="https://vimeo.com/<?=$video?>"><?=$data->titulo?><span><?=$data->descripcion?></span> </a>
<?php endforeach;?>
</div>
</div>
			
		</div>
	</div>
	
</section>
<?php endif;?>