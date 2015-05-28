<section style="padding-top:130px;padding-bottom: 0;" id="products" class="gray-bg padding-top-bottom">

	<div class="container products-detail">
		
		<h1 class="section-title products-detail-header"><?=$model->name?></h1>
		
		<div class="row">
		
			<div class="col-md-6">
				<div style="border-top: 4px solid #<?=$model->shoppingCategories->color?>" class="products-detail-video">
					
					<iframe src="https://player.vimeo.com/video/<?=strtr($model->video_promocional,array(
						'https://vimeo.com/'=>'',
						'http://vimeo.com/'=>'',
						'https://www.vimeo.com/'=>'',
						'http://www.vimeo.com/'=>'',
					))?>" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					
					<div class="products-detail-video-info">
						<p>
							<a style="  margin-right: 10px;" href="<?=$this->createUrl('/shopping/page/items')?>"><i class="fa fa-undo"></i> Todos los cursos</a>
							<a href="<?=$this->createUrl('/shopping/page/items',array('cat_id'=>$model->shoppingCategories->id))?>" style="color:#<?=$model->shoppingCategories->color?>"><i class="fa <?=$model->shoppingCategories->icon?>"></i> Ver mas cursos de <?=$model->shoppingCategories->name?></a>
						</p>
					</div>
				</div>
			</div>
			<div class="products-detail-right col-md-6">
				<p class="products-detail-text"><?=$model->description_detail?></p>
				<?php if($model->material!==array()):?>
				<h3>Material incluido:</h3>
				<ul class="products-detail-text">
					<?php foreach($model->material as $mat):?>
					<li><?=$mat->nombre?></li>
					<?php endforeach;?>
				</ul>	
				<?php endif;?>
				<h3>Temas relacionados:</h3>
				<p class="products-detail-small"><?=$model->temas_relacionados?></p>
			</div>
			
			<div class="col-md-12 products-detail-price">
				<div class="col-md-6" style="border-right: none">
					<?php if($model->free):?>
						<h2>Curso gratuito!!<h2>
						<a data-id="<?=$model->id?>" data-modal="#product-details-modal-<?=$model->id?>"  href="#" class="btn-cart-add-to-cart-free btn btn-qubico btn-green">Tomar gratis</a>
						<br>
					<?php else:?>
						<h2>Valor <strong>$<?=r()->format->money($model->price)?></strong> (COP)<h2>
						<small>Pague seguro a través de PAYULATAM (www.pagosonline.com)</small> <br>
						<a data-id="<?=$model->id?>" data-modal="#product-details-modal-<?=$model->id?>"  href="#" class="btn-cart-add-to-cart btn btn-qubico btn-green">Agregar al carro</a>
						<br>
					<?php endif;?>
					<!-- <img src="<?=r()->theme->baseUrl?>/img/payu.png"> -->
				</div>
				<div class="col-md-6">
					<h2>¿Tienes alguna consulta?</h2>
					<small>Si tienes alguna duda haz clic sobre el boton de contáctenos</small> <br>
					<a data-message="Duda respecto a <?=$model->name?>" class="btn btn-qubico contact-modal" href="#">Contáctanos</a> <br>
					Si prefieres comunicate via telefónica al <a href="tel:<?=$contact_contact->phone?>"><?=$contact_contact->phone?></a>

				</div>
			</div>
			
		</div>

		
	</div>
	
</section>

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