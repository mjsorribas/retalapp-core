<?php
$simbol='$';
if($this->module->justRequest)
  $simbol='';
?><section>
<div class="con-section sub-section" data-site="micrositio">
	<div class="mg-grl clearfix">
		
		<h1 class="main-title clearfix">Historial de premios</h1>
		
		<div id="cart-shopping-header-list-scroll" class="row">
			
			<?php foreach ($model as $i => $data): ?>
		   		<div class="col-sm-12 items-row">
				<div class="row con-title-history">
					<div class="col-md-4 text-left">
						<h3 class="title-history"><?=r()->format->dateDot($data->created_at)?></h3>
					</div>
					<div class="col-md-8 text-right">
						<h3 class="title-history">Total puntos redimidos: <strong><?=$data->total?></strong></h3>
					</div>
					<div class="history-sep"></div>
				</div>
				<div class="row">
<?php $subTotal=0?>
<?php foreach($data->items as $i => $itm):?>
<?php
$row=CActiveRecord::model($itm->table_related)->findByPk($itm->product_id);
$modelFields=$this->module->typesAllowed[$itm->table_related];
$modelId=$modelFields['id'];
$modelUnitValue=$modelFields['unit_value'];
$modelName=$modelFields['name'];
$modelImage=$modelFields['image'];
$modelDescription=$modelFields['description'];
$modelExtra=$modelFields['extra'];

if($row===null)
  continue;
?>
					<div class="col-xs-6 col-sm-4 col-dv col-info">
						<div class="col-catalog">
							<div class="col-fake"></div>
							<div class="catalog">
								<h2 class="text-center">
									<div class="table">
										<div class="table-cell"><?php echo $row->{$modelName}?></div>
									</div>
								</h2>
								<img class="pro-img" src="<?php echo Yii::app()->request->baseUrl?>/uploads/<?php echo $row->{$modelImage}?>" alt="">
								<div class="clearfix"></div>
								<div class="row table">
									<div class="col-xs-6 col-db">
										<div class="table">
											<div class="table-cell">
												<h3 class="text-center">
													<?=$simbol?><?php echo number_format($row->{$modelUnitValue})?>
    											  	<span>Puntos</span>
												</h3>
											</div>
										</div>
									</div>
									<div class="col-xs-6 col-db">
										<div class="row">
											<div class="table">
												<div class="table-cell">
													<div class="col-xs-6">
														<div class="row">
															<div class="con-field col-xs-12 clearfix">
																Cantidad:
															</div>
														</div>
													</div>
													<div class="col-xs-6">
														<div class="row">
															<div class="con-field col-xs-12 clearfix">
																<input class="text-center info-input" value="<?php echo $itm->quantity?>" type="text" readonly>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ Item-->
				<?php endforeach;?>
				
				</div>
			</div> 
			<?php endforeach; ?>
			
		</div>

		<?php $this->widget('ext.widgets.yiinfinite-scroll.YiinfiniteScroller', array(
		    'contentSelector'=>'#cart-shopping-header-list-scroll',
		    'itemSelector'=>'.items-row',
		    'loadingText'=>r('app','Loading...'),
		    'donetext'=>r('app','There are not more items to display'),
		    'pages'=>$pages,
		    'successCallback'=>'function(arrayOfNewElems){ 
		    	console.log(arrayOfNewElems); 
				
				var
					wH = $(window).innerHeight(),
					wW = $(window).innerWidth(),
					colHeight = $(".catalog").innerHeight(),
					colWidth = $(".catalog").innerWidth();
					
				setTimeout(function () {
					$(".col-fake").height(colHeight);
					$(".col-fake").width(colWidth);
					$(".nav-mask").width(wW);
				}, 400);

		    });',
		)); ?>
		
	</div>
</div>
</section>

<?php $this->renderPartial('webroot.themes.itw.views.premios.page._contact_info')?>
