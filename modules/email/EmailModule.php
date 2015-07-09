<?php
require dirname(__FILE__).'/PHPMailer-master/class.phpmailer.php';
require dirname(__FILE__).'/PHPMailer-master/class.pop3.php';
require dirname(__FILE__).'/PHPMailer-master/class.smtp.php';
class EmailModule extends Module
{
    public $showMenuFromAdmin=false;
	private $_model;


	public $colorTemplate='#53B6CF';
	public $colorFontTemplate='#7f8c8d';

	public $SMTPAuth=false;
	// if is auth need full this inputs
	public $Host; // sets the SMTP server
	public $Port=26;                    // set the SMTP port for the GMAIL server
	public $Username; // SMTP account username
	public $Password; 
	
	public $fromEmail;
	public $fromName;
	public $CharSet = 'UTF-8';
	public $AltBody = 'To view the message, please use an HTML compatible email viewer!';

	public $ErrorInfo='';
	private $_dest=array();
	private $_destBCC=array();
	private $_a=array();


	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		defined('EMAIL_ID') or define('EMAIL_ID',$this->id);
		
		$this->setImport(array(
			$this->id.'.models.*',
			$this->id.'.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	public function configItems()
	{
		return array(
	    	array('label'=>ucfirst($this->id), 'icon'=>'fa fa-cogs', 'url'=>array('/'.$this->id.'/back'),'visible'=>Yii::app()->getModule('users')->check('root')),
		);
	}

	/**
	 *
	 * Metodos de uso para modulos de confuguracion
	*/
	// methods for to use witout MVC
	public function getModel()
	{
		if($this->_model===null)
			$this->_model=SmptConfig::model()->find(); 
		return $this->_model;
	}

	public function builtApp($ctr)
	{
		if(($model=$this->getModel())!==null)
		{
			if($model->enabled)
			{
				$this->SMTPAuth=true;
				$this->Host=$model->host_email_server;
				$this->Port=$model->port_email_server;
				$this->fromEmail=$model->username_email_server;
				$this->fromName=Yii::app()->name;
				$this->Username=$model->username_email_server;
				$this->Password=$model->password_email_server;
			}
			if(!$model->enabled)
				$this->SMTPAuth=false;
		}
	}

	public function getTemplatesAvailables()
	{
		$templates=array();
		$pathDir=Yii::getPathOfAlias('application.config.templates');

		if(is_dir($pathDir) and ($handle = opendir($pathDir))) 
		{
		    $blacklist = array('.', '..', '.gitignore');
		    while (false !== ($file = readdir($handle))) 
		    {
		        if (!in_array($file, $blacklist)) {
		            $templateName=strtr($file,array('.php'=>''));
		            $templates[]=$templateName;
		        }
		    }
		    closedir($handle);
		}
		return $templates;
	}
	public function add($mail,$name="")
	{
		$this->_dest[$mail]=$name;
	}
	public function addBCC($mail,$name="")
	{
		$this->_destBCC[$mail]=$name;
	}
	
	public function addAttachment($file)
	{
		$this->_a[]=$file;
	}
	
	public function viewAdd()
	{
		return $this->_dest;
	}

	public function sendBody($subject=null,$context=null,$template='email',$priority=null,$send=true)
	{
		if($context===null)
			$context='Message without body...';
		
		if(is_string($context))
		{
			$str=$context;
			$context=array();	
			$context['body']=$str;
		}

		if(strpos($template, ".")!==false)
			$view=$template;
		else
			$view="application.config.templates.{$template}";

		$context['colorTemplate']=$this->colorTemplate;
		$context['colorFontTemplate']=$this->colorFontTemplate;
		
		$subject=$subject===null?
			Yii::t('app','Notification from').' '.strip_tags(Yii::app()->name):
			$subject;
		$body=Yii::app()->controller->renderPartial($view,$context,true);
		if($send)
			return $this->send($subject,$body,$priority);
		else
			return $body;
	}

	public function previewBody($subject=null,$context=null,$template='email',$priority=null)
	{
		echo $this->sendBody($subject,$context,$template,$priority,false);
	}

	public function addFrom($email,$name)
	{
		$this->fromEmail=$email;
		$this->fromName=$name;
	}

	/**
	 * enviarCorreos
	 * Envía los correos de cada componente
	*/
	public function send($subject=null,$body='',$priority=null)
	{
		$subject=$subject===null?Yii::t('app','Notification from').' '.strip_tags(Yii::app()->name):$subject;
		$charset=$this->CharSet;
		$fromEmail=$this->fromEmail!==null?$this->fromEmail:Yii::app()->params['adminEmail'];
		$fromName=$this->fromName!==null?$this->fromName:strip_tags(Yii::app()->name);
		$altbody=$this->AltBody!==null?$this->AltBody:strip_tags($body);
		
		$this->ErrorInfo='';
		
		$mail = new PHPMailer;
		if($this->SMTPAuth)
		{
			$mail->IsSMTP(); // telling the class to use SMTP
			// $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
			// 1 = errors and messages
			// 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Host       = $this->Host; // sets the SMTP server
			$mail->Port       = $this->Port;                    // set the SMTP port for the GMAIL server
			$mail->Username   = $this->Username; // SMTP account username
			$mail->Password   = $this->Password;        // SMTP account password
			$mail->Mailer = "smtp";
		}
		
		$mail->CharSet = $charset;
		$mail->From       = $fromEmail;
		$mail->FromName   = $fromName;
		$mail->Subject    =$subject;
		$mail->AltBody    = $altbody;

		$mail->MsgHTML($body);
		foreach($this->_a as $file)
			$mail->AddAttachment($file);
		
		foreach($this->_dest as $email=>$name)
			$mail->AddAddress($email,$name);
		foreach($this->_destBCC as $email=>$name)
			$mail->AddBcc($email,$name);

		if(!$mail->send()) {
			$this->ErrorInfo=$mail->ErrorInfo;
			Yii::log('Message could not be sent. Mailer Error: ' . $mail->ErrorInfo,'error','email');
			$this->_dest=array();
			$this->_a=array();
			return false;
		} else {
			$this->ErrorInfo='Message has been sent';
			$this->_dest=array();
			$this->_a=array();
		    return true;
		}
	}

	public function dashboardCounters()
	{
		$model=$this->getModel();
		if($model!==null and !$model->enabled) {
			return array(
	            array('label'=>'SMTP Disabled', 'type'=>'danger', 'icon'=>'fa fa-envelope', 'count'=>'&nbsp;', 'url'=>array('/'.$this->id.'/back')),
	        );
		} else {
			return array();
		}
	}	
}
