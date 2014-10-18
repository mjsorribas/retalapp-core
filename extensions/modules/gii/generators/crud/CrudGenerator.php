<?php
Yii::import('ext.modules.gii.CCodeGenerator');
Yii::import('ext.modules.gii.models.base.BaseGiiCruds');
Yii::import('ext.modules.gii.models.GiiCruds');
class CrudGenerator extends CCodeGenerator
{

	public $title='CRUD';
	public $subTitle='CRUD generator';
	
	public $codeModel='gii.generators.crud.CrudCode';

	/**
	 * Prepares the code model.
	 */
	protected function prepare()
	{
		if($this->codeModel===null)
			throw new CException(get_class($this).'.codeModel property must be specified.');
		$modelClass=Yii::import($this->codeModel,true);
		$model=new $modelClass;
		if(isset($_GET['history']))
		{
			$historySelect=GiiCruds::model()->findByPk($_GET['history']);
			if($historySelect!==null)
				$model->attributes=$historySelect->attributes;
		}

		if(isset($_POST[$modelClass]))
		{
			$model->attributes=$_POST[$modelClass];
			$model->status=CCodeModel::STATUS_PREVIEW;
			if($model->validate())
			{
				$history=new GiiCruds;
				$history->attributes=$model->attributes;
				$history->created_at=date('Y-m-d H:i:s');
				$history->save();
				$model->prepare();
			}
		}
		return $model;
	}
}