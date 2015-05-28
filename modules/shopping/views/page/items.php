<section style="padding-top:130px;padding-bottom: 0;" id="products" class="gray-bg padding-top-bottom">
<div class="container products">
<h1 class="section-title">Cursos</h1>
<div class="row">
	<div class="col-md-12">
		<div style="  margin-top: 0;" class="products-categories">
			<?php foreach($shopping_categories as $data): ?>
			<div class="products-category">
			<a style="color:#<?=$data->color;?>" href="<?=$this->createUrl('/shopping/page/items',array('cat_id'=>$data->id,'slug'=>$data->slug))?>">
				<div style="border-color:#<?=$data->color;?>" class="icon-round">
					<i class="fa <?=$data->icon;?>"></i>
				</div>
				<h4><?=$data->name;?></h4>
			</a>
			</div>
			<?php endforeach; ?>
			<div class="products-category">
			<a style="color:#ccc" href="<?=$this->createUrl('/shopping/page/items')?>">
				<div style="border-color:#ccc" class="icon-round">
					<i class="fa fa-refresh"></i>
				</div>
				<h4 style="margin-bottom:0">Todos</h4>
			</a>
			</div>
		</div>
	</div>
</div>
<?php $this->widget('zii.widgets.CListView', array(
    'id'=>'shopping-items-list',
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'itemsTagName'=>'div',
    'cssFile'=>false,
    'itemsCssClass'=>'row text-center',
    'summaryCssClass'=>'summary text-center mbl',
    'emptyText'=>r('app','Pronto estarán listos los cursos para esta categoría'),
    'template'=>'{items}{pager}',
    'pager'=>array(
        'class'=>'CLinkPager',
        'htmlOptions'=>array(
            'class'=>'pagination pagination-lg'
        ),
        'header'=>false,
    ),
    'pagerCssClass'=>'paginator-container text-center',
    'afterAjaxUpdate'=>'js:function(){
        console.log("Other page...");
    }',
)); ?>
<!-- <div class="row">
	<div class="col-lg-12 text-center">
		<nav>
	      <ul style="margin: 60px 0 0 0;" class="pagination pagination-lg">
	        <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
	        <li><a href="#">1</a></li>
	        <li><a href="#">2</a></li>
	        <li><a href="#">3</a></li>
	        <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
	      </ul>
	    </nav>
	</div>

</div> -->
</div>
</section>