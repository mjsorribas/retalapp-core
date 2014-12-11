<?php

/**
 * Redactor widget
 *
 * @author Jani Mikkonen <janisto@php.net>
 * @version 1.1
 * @license public domain (http://unlicense.org)
 * @package extensions.redactor
 * @link http://imperavi.com/redactor/
 */

class GSummerNote extends CInputWidget {
	
	public $height='250px';
	
	/**
	 * Assets package ID.
	 */
	const PACKAGE_ID = 'redactor-widget';

	/**
	 * @var string path to assets
	 */
	protected $assetsPath;

	/**
	 * @var string URL to assets
	 */
	protected $assetsUrl;

	/**
	 * @var array redactor options
	 * @see http://redactorjs.com/docs
	 */
	public $options = array();

	/**
	 * @var string|null textarea selector for jQuery
	 */
	public $selector;

	/**
	 * Init widget
	 */
	public function init()
	{
		parent::init();
		if ($this->assetsPath === null) {
			$this->assetsPath = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		}
		if ($this->assetsUrl === null) {
			$this->assetsUrl = Yii::app()->assetManager->publish($this->assetsPath);
		}
		if ($this->selector === null) {
			list($this->name, $this->id) = $this->resolveNameId();
			$this->selector = '#' . $this->id;
		}
		$this->registerClientScript();
	}

	/**
	 * Run widget.
	 */
	public function run()
	{
		if ($this->hasModel()) {
			echo CHtml::activeTextArea($this->model, $this->attribute, $this->htmlOptions);
		} else if ($this->selector !== null) {
			echo CHtml::textArea($this->name, $this->value, $this->htmlOptions);
		}
	}

	/**
	 * Register CSS and scripts.
	 */
	protected function registerClientScript()
	{
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile($this->assetsUrl.'/dist/summernote.min.js');
		$cs->registerCssFile($this->assetsUrl.'/dist/summernote.css');
		$cs->registerCss('SummernotePadding',"
			.note-editor .note-toolbar {
				margin-left: 0;
			}
		");
		
		if(!isset($this->options['height']))
			$this->options['height']=$this->height;

		$cs->registerScript(
			__CLASS__ . '#' . $this->id,
			'jQuery('. CJavaScript::encode($this->selector) .').summernote('. CJavaScript::encode($this->options) .');',
			CClientScript::POS_READY
		);
	}
}