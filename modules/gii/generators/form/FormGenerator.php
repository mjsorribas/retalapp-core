<?php

class FormGenerator extends CCodeGenerator
{
	public $codeModel='gii.generators.form.FormCode';
	public $title='FORM';
	public $subTitle='FORM generator';
	
	/**
	 * Prepares the code model.
	 */
	protected function prepare()
	{
		if($this->codeModel===null)
			throw new CException(get_class($this).'.codeModel property must be specified.');
		$modelClass=Yii::import($this->codeModel,true);
		$model=new $modelClass;
	
		// $model->loadStickyAttributes();
		if(isset($_POST[$modelClass]))
		{
			$model->attributes=$_POST[$modelClass];
			$model->viewPath=$model->moduleName.'.views';
			// echo CJSON::encode($model);
			// exit;
			$model->status=CCodeModel::STATUS_PREVIEW;
			if($model->validate())
			{
				// $model->saveStickyAttributes();
				$model->prepare();
			}
		}
		return $model;
	}
}