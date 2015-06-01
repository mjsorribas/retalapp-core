<section style="min-height: 900px;height: 100%;padding-top: 0;padding-bottom: 0;" id="products" class="color-bg padding-top-bottom">

	<div class="container">
	
<div style="padding-bottom: 0;padding-top: 50px;" id="products" class="color-bg  col-lg-6 container-landing">

	<div class="col-md-12" style="border-right:none">
		<h1 style="color:#ffffff" class="products-detail-header"><?=$model->name?></h1>
		<div style="border-top: 4px solid #fff" class="">
			
			<?php if(!empty($model->video)):?>
			<iframe src="https://player.vimeo.com/video/<?=strtr($model->video,array(
				'https://vimeo.com/'=>'',
				'http://vimeo.com/'=>'',
				'https://www.vimeo.com/'=>'',
				'http://www.vimeo.com/'=>'',
			))?>" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			<?php elseif(!empty($model->image)):?>
				<img style="width:100%" src="<?=$model->image_path?>" alt="<?=$model->name?>">
			<?php endif;?>
			
			
		</div>

		<div class="questions col-lg-12">
		
		<?php foreach($model->features as $data):?>
        <div class="questions-container">
        <div class="col-lg-2">
            <div class="questions-icon">
                <div class="icon-round">
                    <i class="fa <?=$data->icon?>"></i>
                </div>
            </div>
        </div>
        <div class="question-response col-lg-10">
            <h2><?=$data->name?></h2>
            <p><em><?=r()->format->toBr($data->description)?></em></p>
        
        </div>
        </div>
		<?php endforeach;?>
        
		
		</div>
	</div>
	
</div>

<div style="padding-bottom: 0;padding-top: 50px;min-height: 900px;height: 100%;" id="products" class="blue-bg col-lg-6">

	<div class="col-md-12 container-embed-code-header">
		<h4><?=$model->call?></h4>
		<p><?=$model->call_text?></p>
		<div class="container-embed-code">
			<?=$model->code?>
		</div>
	</div>
	
</div>

</div>
	
</section>


