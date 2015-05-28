<?php

class InfoController extends CmsController
{
	public $defaultAction='index';
	public $title='<i class="fa fa-star-half-o"></i> Home Información';
	public $subTitle='Admin Home Información';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','upload','pdf'),
				'roles'=>$this->module->getAllowPermissoms(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionIndex()
	{
		$this->title='<i class="fa fa-star-half-o"></i> '.Yii::t('app','Home Información');
		$this->subTitle='Admin '.Yii::t('app','Home Información');
		
		$model=ShoppingInfo::model()->find();
		if($model===null)
			$model=new ShoppingInfo;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ShoppingInfo']))
		{
			$model->attributes=$_POST['ShoppingInfo'];
			if($model->save())
	        {
            	Yii::app()->user->setFlash('success',Yii::t('app','The record was saved successfully'));
                $this->refresh();
            }
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionPdf()
	{
		$model=ShoppingInfo::model()->find();
		$content=$this->renderPartial('view',array(
			'model'=>$model,
		),true);

		$html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'es');
	    // $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content);
		$html2pdf->Output('ShoppingInfo.pdf');
	}

	//////////////////////////
	// Reutilizable methods //
	//////////////////////////
	/**
	 * Performs the AJAX validation.
	 * @param ShoppingInfo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='shopping-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
