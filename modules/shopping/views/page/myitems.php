<section style="padding-top:130px;padding-bottom: 0;" id="products" class="gray-bg padding-top-bottom">
<div class="container products">
<h1 class="section-title">Mis Cursos <?php if(!r()->user->isGuest):?><small>Bienvenido <?=r()->user->name?></small><?php endif;?></h1>

<?php $this->widget('zii.widgets.CListView', array(
    'id'=>'shopping-items-list',
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view_my',
    'itemsTagName'=>'div',
    'cssFile'=>false,
    'itemsCssClass'=>'row text-center',
    'summaryCssClass'=>'summary text-center mbl',
    'emptyText'=>r('app','No tienes cursos comprados aún, vamos adelante <br>mira nuestros cursos y adquiere el que más se adapta a tus necesitades <br>'."<a class=\"btn btn-qubico btn-green\" href=\"".$this->createUrl('page/items')."\">Comprar cursos</a>"),
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