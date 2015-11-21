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
<?php echo "<?php if(!\$model->isNewRecord and \$model->city!==null):?>\n"?>
<?php echo "    <?php \$model->{$this->viewName}=\$model->city->{$this->viewName};?>\n"?>
<?php echo "<?php endif;?>\n"?>

<?php echo "<?php \$cityHtmlOptions=array(
    'ajax' => array(
        'type'=>'POST', //request type
        'url'=>\$this->createUrl('cities'), //url to call.
        'update'=>'#".$this->modelClass."_users_location_cities_id',
    ),
    'class'=>'form-control','empty'=>'Select...'
);?>\n"?>
<?php echo "<?php
\$listData=array();
if(!\$model->isNewRecord)
    \$listData=CHtml::listData(UsersLocationCities::model()->findAll(array(
        'condition'=>'t.users_location_states_id=?',
        'params'=>array(\$model->{$this->viewName})
    )),'id','name');
?>\n"?>

<div class="form-group">
    <?php echo "<?php echo \$form->labelEx(\$model,'{$this->viewName}',array('class'=>'control-label')); ?>\n"?>
    <?php echo "<?php echo \$form->dropDownList(\$model,'{$this->viewName}',CHtml::listData(UsersLocationStates::model()->findAll(),'id','name'),\$cityHtmlOptions); ?>\n"?>
    <?php echo "<?php echo \$form->error(\$model,'{$this->viewName}',array('class'=>'help-block')); ?>\n"?>
</div>

<div class="form-group">
    <?php echo "<?php echo \$form->labelEx(\$model,'users_location_cities_id',array('class'=>'control-label')); ?>\n"?>
    <?php echo "<?php echo \$form->dropDownList(\$model,'users_location_cities_id',\$listData,\$cityHtmlOptions); ?>\n"?>
    <?php echo "<?php echo \$form->error(\$model,'users_location_cities_id',array('class'=>'help-block')); ?>\n"?>
</div>

<?php echo "<?php
public function actionCities()
{
    \$cities=UsersLocationCities::model()
    ->findAll(array(
        'condition'=>'t.users_location_states_id=?',
        'params'=>array(\$_POST['".$this->modelClass."']['{$this->viewName}'])
    ));
    
    foreach(\$cities as \$val)
        echo CHtml::tag('option',array('value'=>\$val->id),\$val->name,true);
}\n";
?>
