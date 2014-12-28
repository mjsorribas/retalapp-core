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
    <?php echo "<?php foreach (\$model as \$i => \$data): ?>\n"?>
	<div class="col-lg-3 items-row">
		<a class="item_list" href="<?php echo "<?php echo \$this->createUrl('view', array('id' => \$data->id)) ?>"?>">
            <h2><?php echo "<?=\$data->id ?>"?></h2>
        </a>
    </div>
    <?php echo "<?php endforeach; ?>\n"?>
</div>

<?php echo "<?php"; ?> $this->widget('ext.widgets.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector'=>'#<?php echo $this->class2id($this->modelClass); ?>-list-scroll',
	'itemSelector'=>'.items-row',
    'loadingText'=>r('app','Loading...'),
    'donetext'=>r('app','There are not more items to display'),
    'pages'=>$pages,
    'successCallback'=>'function(arrayOfNewElems){ console.log(arrayOfNewElems); });',
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
		// 	TODO TEST
		// 	$.ajax({
		// 		type:'get',
		// 		url:'',
		// 		data:{search: search},
		// 		success: function(data){
		//           console.log(data);
		//		},
		// 	});
    });
});
</script>