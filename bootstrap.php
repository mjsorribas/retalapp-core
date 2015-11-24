<?php

// you need to change this for your timezone
// date_default_timezone_set("America/Bogota"); 

// change the following paths if necessary
$framework=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/config/main.php';

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($framework);

Yii::setPathOfAlias('app',dirname(__FILE__).'/../../../app');
Yii::setPathOfAlias('vendor',dirname(__FILE__).'/../../../vendor');
Yii::setPathOfAlias('core',dirname(__FILE__));

$dbPath=Yii::getPathOfAlias('app').'/config/database.php';
$dbPathExample=Yii::getPathOfAlias('app').'/config/database.sample.php';
$dbPathSql=Yii::getPathOfAlias('app').'/config/retalapp.sql';
// echo $db;
// exit;
$alert='';
if(!file_exists($dbPath)) {
if(isset($_GET['step']) and $_GET['step']==1) {

// Here's a startsWith function
function startsWith($haystack, $needle){
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function run_sql_file($location,$conn){
    //load file
    $commands = file_get_contents($location);

    //delete comments
    $lines = explode("\n",$commands);
    $commands = '';
    foreach($lines as $line){
        $line = trim($line);
        if( $line && !startsWith($line,'--') ){
            $commands .= $line . "\n";
        }
    }

    //convert to array
    $commands = explode(";", $commands);

    //run commands
    $total = $success = 0;
    foreach($commands as $command){
        if(trim($command)){
            $success += (mysqli_query($conn,$command)==false ? 0 : 1);
            $total += 1;
        }
    }

    //return number of successful queries and total number of queries found
    return array(
        "success" => $success,
        "total" => $total
    );
}

	$dbConfigContent=file_get_contents($dbPathExample);
	$dbCreated=array(
        "success" => 0,
        "total" => 0
    );
	$error=false;
	$errorMessage='';

	if(count($_POST)>0) {
		
		if(!$error and (empty($_POST['host']) or empty($_POST['db']) or empty($_POST['username']))) { 
			$error=true;
			$errorMessage='Por favor ingrese todos los datos';
		}

		$servername = $_POST['host'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$dbname = $_POST['db'];

		// Create connection
		$conn = @mysqli_connect($servername, $username, $password, $dbname);

		if(!$error and (!$conn)) { 
			$error=true;
			$errorMessage="Fallo la conección corrija los datos de conexión y recuerde que la base de datos debe esta creada con el mismo nombre que usted ingresa aqui.";
		}

		$dbPathSqlContent = file_get_contents($dbPathSql);
		$sql = strtr($dbPathSqlContent,array(
			'{{randonPassword}}'=>''
		));

		if(!$error and (!($dbCreated=run_sql_file($dbPathSql,$conn)))) {
		    $error=true;
		    $errorMessage="Error en el sql a importar: <br>" . mysqli_error($conn);
		} else {
			// $dbCreated=true;
		}

		$contentFile=strtr($dbConfigContent,array(
			'{{currentHost}}'=>$_SERVER['HTTP_HOST'],
			'{{host}}'=>$_POST['host'],
			'{{db}}'=>$_POST['db'],
			'{{username}}'=>$_POST['username'],
			'{{password}}'=>$_POST['password'],
		));
		$file = @fopen($dbPath, "w");
		if(!$error and @fwrite($file, $contentFile)===false) {
			$contentArea='Crea un archivo aqui '.$dbPath.' con este contenido.<br>';
			$contentArea.='<textarea class="form-controll" style="height:500px;width:100%;">'.$contentFile.'</textarea><div></div>';
			
			$contentBox='';
			$contentBox.=$contentArea;
			$error=true;
			$errorMessage='No me deja crear el archivo, por favor haslo por mi.<br>';
	
		}
		@fclose($file);

		if($conn)
			mysqli_close($conn);
		
		if($dbCreated) {
			// header('location:/');
		}
	}
	$alert='';
	if($error) {
		$alert='<div class="alert alert-danger">'.$errorMessage.'</div>';
	}

	$contentBox='';
	$contentBox.='<p>A continuación deberás introducir los detalles de conexión a tu base de datos. Si no estás seguro de esta información contacta con tu proveedor de alojamiento web.</p>';
	
	$content='';
		$content.='<form method="post">';
	if(!$dbCreated['success']) {
		$content.='<input class="form-control" value="'.((!empty($_POST['host']))?($_POST['host']):'').'" type="text" name="host" placeholder="Servidor ej:localhost"><br>';
		$content.='<input class="form-control" value="'.((!empty($_POST['db']))?($_POST['db']):'').'" type="text" name="db" placeholder="Base de datos"><br>';
		$content.='<input class="form-control" value="'.((!empty($_POST['username']))?($_POST['username']):'').'" type="text" name="username" placeholder="Usuario"><br>';
		$content.='<input class="form-control" value="'.((!empty($_POST['password']))?($_POST['password']):'').'" type="text" name="password" placeholder="Password"><br>';
		$content.='<input class="btn btn-lg btn-primary" type="submit" name="enviar" value="Enviar"><br>';
	} else {
		$content.='<input value="'.((!empty($_POST['host']))?($_POST['host']):'').'" type="hidden" name="host" placeholder="Servidor ej:localhost"><br>';
		$content.='<input value="'.((!empty($_POST['db']))?($_POST['db']):'').'" type="hidden" name="db" placeholder="Base de datos"><br>';
		$content.='<input value="'.((!empty($_POST['username']))?($_POST['username']):'').'" type="hidden" name="username" placeholder="Usuario"><br>';
		$content.='<input value="'.((!empty($_POST['password']))?($_POST['password']):'').'" type="hidden" name="password" placeholder="Password"><br>';
		$content.='<input class="btn btn-lg btn-primary" type="submit" name="enviar" value="Vamos alla ya los creé"><br>';
	}
		$content.='</form>';



	$contentForm='<p>'.$contentBox.'</p>'.$content;
} else {
	$contentForm='<p>Bienvenido a Retalapp. Antes de empezar necesitamos alguna información de la base de datos. Necesitarás saber lo siguiente antes de continuar.</p>';
	$contentForm.='<ol>
		<li>Nombre de la base de datos</li>
		<li>Usuario de la base de datos</li>
		<li>Contraseña de la base de datos</li>
		<li>Servidor de la base de datos</li>
		<li>Prefijo de la tabla (si quieres ejecutar más de un WordPress en una sola base de datos)</li>
	</ol>';
	$contentForm.='<p>
	Vamos a utilizar esta información para crear el archivo <code>app/config/database.php</code>.	<strong>Si por cualquier motivo la creación automática del archivo no funciona no te preocupes. Lo que hace este proceso es rellenar un fichero de configuración con la información de la base de datos. También puedes simplemente abrir el archivo <code>app/config/database.sample.php</code> en un editor de texto, rellenarlo con tu información, y guardarlo como <code<app/config/database.php< code="">. </code<app/config/database.php<></strong>
	<!-- ¿Necesitas más ayuda? <a href="">La tenemos</a>. -->
	</p>';
	$contentForm.='<p>Con toda probabilidad, tu alojamiento web te ha dado la información de estos elementos. Si no tienes esta información, necesitarás contactar con ellos antes de continuar. Si estás listo, …</p>';
	$contentForm.='<p class="step"><a href="index.php?step=1" class="btn btn-lg btn-primary">¡Vamos a ello!</a></p>';
}

	echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title>Retalapp inataller</title>
    <meta name="Keywords" content="Site, Blog, webapp" lang="es">
    <meta name="Description" content="MyApp is a site..." lang="es">
</head>

  <body>

<div class="container">
	<div class="text-center">
		<img src="img/retalapp-logo.png" style="width:80px;margin: 20px auto;" class="img-responsive">
	</div>
<div class="col-md-8 col-md-offset-2">
    <div class="jumbotron">
		'.$alert.'
        '.$contentForm.'
    </div>
</div>
</div>

</body>
</html>';

	exit;
}


function r($module=null,$message=null,$params=array()) {
	
	if($module===null)
		return Yii::app();
	
	if($module!==null and $message!==null)
		return Yii::t($module,$message,$params);

	if(stripos($module, '#')!==false)
		return Yii::app()->getComponent(substr($module, 1));

	return Yii::app()->getModule($module);
}

Yii::createWebApplication($config)->run();
