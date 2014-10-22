<?php
/**
 * This is the template for generating the action script for the form.
 * - $this: the CrudCode object
 */
?>
<?php
$viewName=basename($this->viewName);
?>

/**
 * Update a model.
 * If update is successful, return a json with updated data.
 */
public function action<?php echo ucfirst(trim($viewName,'_')); ?>()
{
    if(!Yii::app()->request->isAjaxRequest)
        throw new CHttpException(403,"Petición inválida, probablemente ha fallado el JavaScript de su navegador.");
    
    $model=new <?php echo $this->modelClass; ?><?php echo empty($this->scenario) ? '' : "('{$this->scenario}')"; ?>;

    if(isset($_POST['<?php echo $this->modelClass; ?>']))
    {
        $model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
        if($model->validate())
        {
            // do something here
            echo CJSON::encode($model);
            Yii::app()->end();
        }
        if($model->getErrors()!==array() and isset($_POST['ajax']) and $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
        {
            $result=array();
            foreach($model->getErrors() as $attribute=>$errors)
                $result[CHtml::activeId($model,$attribute)]=$errors;    
            echo CJSON::encode($result);
            Yii::app()->end();
        }
    }
    
    echo CJSON::encode($model);
    Yii::app()->end();
}

// paste this in your target view (Not put into a form)
<?php echo "<?php \$this->renderPartial('{$viewName}',array('model'=>new {$this->modelClass}));?>";?>

// paste this in your target view
<a data-toggle="modal" class="btn btn-default" data-target="#<?php echo $this->class2id($this->modelClass)?>-modal" href="#"><?php echo $this->class2id($this->modelClass)?></a>