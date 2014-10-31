<?php
/**
 * GFrontUpload class file.
 *
 * @author Gustavo Salgado <gsalgadotoledo@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * GFrontUpload displays a star rating control that can collect user rating input.
 *
 * @author Gustavo Salgado <gsalgadotoledo@gmail.com>
 * @package system.web.widgets
 * @since 1.0
 */
class GFrontUpload extends CInputWidget
{

	public $typeError;
	public $sizeError;
	public $minSizeError;
	public $emptyError;
	public $onLeave;

	public $sizeValidate=array(); // $this->createUrl('upload')
	public $actionUrl; // $this->createUrl('upload')
	public $containerCss='stick-image';
	public $buttonText='Seleccione un archivo';
	public $allowedExtensions=array('png','jpg','jpeg');
	public $templateSmall='Tamaño recomendado ({width}px X {height}px)';
	public $cssFile=false;
	public $iconButtom='fa-camera';
	public $imgContainerOptions=array();
	public $messageCallback="function(message){ 
          alert(message);
      }";
	public $selector;
	public $selectorImg;
	public $successCallback="console.log(uploadDir,responseJSON.fileName);";

	public $width='300';
	public $height='400';
	public $crop=false;

	// @TODO Implementar extensiones y iconos
	public $iconExtensions=array('pdf'=>'fa fa-file-pdf-o fa-5x');

	/**
	 * Executes the widget.
	 * This method registers all needed client scripts and renders
	 * the text field.
	 */
	public function run()
	{
		$uploadDir=Yii::app()->baseUrl.'/uploads';
		list($name,$id)=$this->resolveNameID();
		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id."_hidden";
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];

		$this->registerClientScript($id);
	    
	    if($this->sizeValidate!==array() and isset($this->sizeValidate['width'],$this->sizeValidate['height']))
	    {
	    	$this->width=$this->sizeValidate['width'];
	    	$this->height=$this->sizeValidate['height'];
	    }

	    if($this->selector===null)
	    {
	 	   echo '<a id="'.$id."_hidden".'" style="float: right;
margin-top: -30px;
color: #7597a0;
padding-right: 15px;" href="#">
<span class="qq-up-file">Subir <i class="fa fa-cloud-upload"></i></span>
<i style="display:none" class="qq-loading-file fa fa-refresh fa-spin"></i>
</a>';
	    }                      
        echo CHtml::hiddenField($name."_hidden",$this->value,$this->htmlOptions);
	}

	/**
	 * Registers the necessary javascript and css scripts.
	 * @param string $id the ID of the container
	 */
	public function registerClientScript($id)
	{
		$this->typeError=Yii::t('app',"Unfortunately the file(s) you selected weren't the type we were expecting. Only {extensions} files are allowed.");
		$this->sizeError=Yii::t('app',"{file} is too large, maximum file size is {sizeLimit}.");
		$this->minSizeError=Yii::t('app',"{file} is too small, minimum file size is {minSizeLimit}.");
		$this->emptyError=Yii::t('app',"{file} is empty, please select files again without it.");
		$this->onLeave=Yii::t('app',"The files are being uploaded, if you leave now the upload will be cancelled.");
		
		$params=$this->sizeValidate===array()?'{}':CJSON::encode($this->sizeValidate);
		$uploadDir=Yii::app()->baseUrl.'/uploads';
		
		$selectorCall=($this->selector!==null)?$this->selector:"#{$id}_hidden";
		

		//    		var iconExtensions = ".CJSON::encode($this->iconExtensions).";
		//    		$('.{$this->containerCss}.{$id}_img').empty();
				
		//    		var ext = responseJSON.fileName.split('.').pop();
		//    		var filenamePreview = responseJSON.fileName;
		//    		var html = '<img id=\"jcrop_target{$id}\" class=\"img-responsive img-rounded\" src=\"{$uploadDir}/'+filenamePreview+'\" alt=\"\">';
				
		//    		if(iconExtensions[ext]) {
					// filenamePreview = iconExtensions[ext];
		//    			html = '<div class=\"text-center\"><a href=\"{$uploadDir}/'+responseJSON.fileName+'\" target=\"_blank\"><i class=\"'+filenamePreview+'\"></i></a></div>';
		//    		}
		//    		$('#{$id}').val(responseJSON.fileName);
		//    		$('.{$this->containerCss}.{$id}_img').html(html);

		$js="
			var uploader{$id} = new qq.FileUploaderBasic({
		        button: document.getElementById('".strtr($selectorCall, array('#'=>''))."'),
		        multiple: false,
		        action: '{$this->actionUrl}',
		        params: {$params},
		        allowedExtensions: ".CJSON::encode($this->allowedExtensions).",
		        showMessage: ".$this->messageCallback.",
		        messages: {
					typeError: \"{$this->typeError}\",
					sizeError: \"{$this->sizeError}\",
					minSizeError: \"{$this->minSizeError}\",
					emptyError: \"{$this->emptyError}\",
					onLeave: \"{$this->onLeave}\"
				},
				onSubmit: function(id, fileName){
					console.log(fileName);
					if($('[name={$id}]')) {
						$('[name={$id}]').val(fileName.substr(0, 20)+'...');
					}
					$('{$selectorCall} .qq-up-file').hide();
					$('{$selectorCall} .qq-loading-file').show();
				},
       			onProgress: function(id, fileName, loaded, total){
       				console.log(id, fileName, loaded, total);
       			},
       			onError: function(id, fileName, xhr) {
					$('{$selectorCall} .qq-up-file').show();
					$('{$selectorCall} .qq-loading-file').hide();
					$('[name={$id}_hidden]').val('');
					if($('[name={$id}]')) {
						$('[name={$id}]').val('');
					}
       			},
        		onComplete: function(id, fileName, responseJSON){
		        	var uploadDir = '{$uploadDir}';
		        	if(responseJSON.success) {
		        		console.log(responseJSON.fileName);
        			
	        			$('{$selectorCall} .qq-up-file').show();
						$('{$selectorCall} .qq-loading-file').hide();
						$('[name={$id}_hidden]').val(responseJSON.fileName);
						{$this->successCallback}

		        	} else {
		        		$('{$selectorCall} .qq-up-file').show();
						$('{$selectorCall} .qq-loading-file').hide();
						$('[name={$id}_hidden]').val('');
						if($('[name={$id}]')) {
							$('[name={$id}]').val('');
						}
       				}
		        },
		    });
		";

		$assets=Yii::app()->assetManager->publish(dirname(__FILE__)."/assets/");
		$cs=Yii::app()->getClientScript();
		// $cs->registerScript('ext.GUpload#jquery'.$id,$jq);
		$cs->registerScript('ext.GUpload#'.$id,$js,CClientScript::POS_LOAD);
		$cs->registerScriptFile($assets."/fileuploader.js",CClientScript::POS_HEAD);
		
		// $cs->registerCss('ext.GUploadCss#'.$id,"
		// 	{$cropCss}
		// 	.qq-upload-list {
		// 		/*display: none;*/
		// 	}
		// 	.qq-upload-failed-text {
		// 		display: none;
		// 	}
		// 	.qq-upload-drop-area {
		// 		text-align: center;
		// 		color: #ccc;
		// 		font-size: 0.9em;
		// 		padding: 10px 0 10px 0;
		// 	}
		// 	.tile.qq-upload-extra-drop-area {
		// 		border-radius: 8px;
		// 		border: 6px #f0f0f0 dotted;
		// 		min-height: 50px;
		// 	}
		// ");

		if($this->cssFile!==false)
			self::registerCssFile($this->cssFile);
	}

	/**
	 * @TODO
	 * Registers the needed CSS file.
	 * @param string $url the CSS URL. If null, a default CSS URL will be used.
	 */
	public static function registerCssFile($url=null)
	{
		$cs=Yii::app()->getClientScript();
		if($url===null)
			$url=$cs->getCoreScriptUrl().'/path/to/my.css';
		$cs->registerCssFile($url);
	}
}