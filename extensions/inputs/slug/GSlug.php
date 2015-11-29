<?php
/**
 * GInput class file.
 *
 * @author Gustavo Salgado <gsalgadotoledo@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * GInput displays a star rating control that can collect user rating input.
 *
 * GInput is based on {@link http://www.fyneworks.com/jquery/star-rating/ jQuery Star Rating Plugin}.
 * It displays a list of stars indicating the rating values. Users can toggle these stars
 * to indicate their rating input. On the server side, when the rating input is submitted,
 * the value can be retrieved in the same way as working with a normal HTML input.
 * For example, using
 * <pre>
 * $this->widget('pat.to.location.GInput',array('name'=>'rating'));
 * </pre>
 * we can retrieve the rating value via <code>$_POST['rating']</code>.
 *
 * GInput allows customization of its appearance. It also supports empty rating as well as read-only rating.
 *
 * @author Gustavo Salgado <gsalgadotoledo@gmail.com>
 * @package system.web.widgets
 * @since 1.0
 */
class GSlug extends CInputWidget
{
	
	public $field='name';
	public $disclamer;

	private $_assets;
	
	/**
	 * Executes the widget.
	 * This method registers all needed client scripts and renders
	 * the text field.
	 */
	public function run()
	{
		
		list($name,$id)=$this->resolveNameID();
		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;
		if(isset($this->htmlOptions['name']))
			$name=$this->htmlOptions['name'];

		$this->registerClientScript($id);
		$this->htmlOptions["class"]="form-control";
		if($this->disclamer===null) {
			echo "<small class=\"text-muted\"><em>".r('app','Type the url that will be used for retrive this element')."</em></small>";
		} else {
			echo $this->disclamer;
		}
		echo CHtml::activeTextField($this->model,$this->attribute,$this->htmlOptions);
		
	}

	/**
	 * Registers the necessary javascript and css scripts.
	 * @param string $id the ID of the container
	 */
	public function registerClientScript($id)
	{
		$js="
			$(document).on('keyup change','#".get_class($this->model)."_".$this->field."',function(e){
		        var slug = $(this).val().toLowerCase()
		        .replace('á','a')
		        .replace('é','e')
		        .replace('í','i')
		        .replace('ó','o')
		        .replace('ú','u')
		        .replace('ñ','n')
		        .replace(/[^\w ]+/g,'')
		        .replace(/ +/g,'-');
		        $('#".get_class($this->model)."_".$this->attribute."').val(slug);
		    });
		";
		$cs=Yii::app()->getClientScript();
		$cs->registerScript('ext.GSlug#'.$id,$js,CClientScript::POS_END);
	}
}
