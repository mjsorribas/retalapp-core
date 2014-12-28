<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
$label=$this->pluralize($this->class2name($this->modelClass));
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $dataProvider CActiveDataProvider */

?>

<h3><?php echo $label; ?></h3>

<!-- SEARCH FORM -->
<div class="row mbl mtl">
	<div class="col-lg-2">&nbsp;</div>
	<div class="col-lg-8">
		<div class="input-group">
	      <input data-action="search" type="text" class="form-control">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
	      </span>
	    </div>
	</div>
	<div class="col-lg-2">&nbsp;</div>
</div>
<a class="btn btn-default" href="<?php echo "<?php echo \$this->createUrl('create')?>"?>">Create</a>

<!-- LIST OF ELEMENTS -->
<div class="row">
	<div class="col-lg-12">

<div id="<?php echo $this->class2id($this->modelClass); ?>-list-scroll" class="row">
    <?php foreach ($model as $i => $data): ?>
	<div class="col-lg-3 items-row" style="<?php echo $i%4==0?"margin-left:0px":"";?>">
		<a class="item_list" href="<?php echo $this->createUrl('view', array('id' => $data->id)) ?>">
            <h2><?php echo $data->id ?></h2>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#<?php echo $this->class2id($this->modelClass); ?>-list-scroll',
    'itemSelector' => '.items-row',
    'loadingText' => 'Cargando...',
    'donetext' => 'No hay mas items para mostrar',
    'pages' => $pages,
    'successCallback' => 'function(arrayOfNewElems){ console.log(arrayOfNewElems); });',
));?>


<?php echo "<?php"; ?> $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'id'=>'<?php echo $this->class2id($this->modelClass); ?>-list-scroll',
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'itemsTagName'=>'div',
    'cssFile'=>false,
    'itemsCssClass'=>'row text-center',
    'summaryCssClass'=>'summary text-center mbl',
    'emptyText'=>r('app','There is nothing here yet, start now').' <br> <a href="'.$this->createUrl("create").'" class="btn btn-primary">'.r('app','Create').'</a>',
    'pager'=>array(
    	'class'=>'CLinkPager',
    	'htmlOptions'=>array(
    		'class'=>'pagination'
		),
		'header'=>false,
	),
    'pagerCssClass'=>'paginator-container',
)); ?>
	</div>
</div>

<script>
$(function () {
	
	/**
	 * Search functionality 
	 * in each keayup event call
	*/
	$(document).on('keyup','[data-action=search]',function (e) {
        var search = $(e.currentTarget).val();
    	console.log(search);
		// 	$.fn.yiiListView.update('<?php echo $this->class2id($this->modelClass); ?>-list-scroll',{
		// 		data:{search: search}
		// 	});
    });
});
</script>