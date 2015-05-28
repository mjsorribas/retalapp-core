<div class="col-md-4">
	<a class="products-link" href="<?=$this->createUrl("/shopping/page/view",array('id'=>$data->id,'slug'=>$data->slug))?>">
	<div style="border-top-color: #<?=$data->shoppingCategories->color?>;" class="products-item">
		<h2 class="products-item-title"><?=$data->name?></h2>
		<div class="products-img">
			<img src="<?=$data->image_path?>">
		</div>
		<p><?php if($data->free):?><span class="label label-success products-free"><?=Yii::t('app','Curso gratis')?></span><?php endif;?><?=r()->format->toBr($data->description);?></p>
	</div>
	</a>
</div>
