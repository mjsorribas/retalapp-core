<?php
/**
 * This is the template for generating the action script for the form.
 * - $this: the CrudCode object
 */
?>
<?php
$this->modelClass;
$viewName=basename($this->viewName);
?>
<a href="#" id="id-link-selected">Upload image</a>
<div id="div-preview"></div>
<input type="hidden" name="<?=$this->viewName?>"/>
<?php echo "<?php echo \$this->widget('ext.inputs.uploader.GFrontUpload', array(
    'selector' => '#id-link-selected',
    'successCallback'=>\"
      $('[name={$this->viewName}]').val(responseJSON.fileName);
      $('#div-preview').html('<img style=\"width:30px\" src=\"'+uploadDir+'/'+responseJSON.fileName+'\" title=\"Clic para insertar {$this->viewName}\"/>');
    \",
    'name' => '{$this->viewName}',
    'value' => \$model->{$this->viewName},
    'allowedExtensions' => array('png','jpg','jpeg'),
    'actionUrl' => \$this->createUrl('upload'),
),true)?>"?>