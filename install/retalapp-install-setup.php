<?php
$dbPath=Yii::getPathOfAlias('app').'/config/database.php';
$dbPathExample=Yii::getPathOfAlias('app').'/config/database.sample.php';
$dbPathSql=Yii::getPathOfAlias('app').'/config/retalapp.sql';
require_once(Yii::getPathOfAlias('core').'/install/retalapp-install-functions.php');

$contentInstall='';
$dbConfigContent=file_get_contents($dbPathExample);
$dbCreated=array(
    "success" => 0,
    "total" => 0
);
$error=false;
$errorMessage='';
session_start();

if(file_exists($dbPath)) {

  $db=require($dbPath);
  $dbConfig=$db['localhost'];
  if(isset($_SERVER['HTTP_HOST']) and isset($db[$_SERVER['HTTP_HOST']]))
      $dbConfig=$db[$_SERVER['HTTP_HOST']];
    
    $serverSplit=explode(';', strtr($dbConfig['connectionString'],array('mysql:'=>'')));
  $servername = strtr($serverSplit[0],array('host='=>''));
  $dbname = strtr($serverSplit[1],array('dbname='=>''));
  $username = $dbConfig['username'];
  $password = $dbConfig['password'];

  $conn = @mysqli_connect($servername, $username, $password, $dbname);
  if($conn) {

    $sql = "SHOW TABLES FROM {$dbname}";
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows<=0) {
      $errorMessage='';
      $dontInstall=false;
      if(count($_POST)>0) {
        
        if((empty($_POST['email']) 
                  or empty($_POST['username'])
                  or empty($_POST['title'])
                  or empty($_POST['password']))
          ) {
          $errorMessage='<div class="alert alert-danger">Por favor complete los datos.</div>';
          $dontInstall=true;
        }

        if(!$dontInstall and (!isset($_POST['___install']) or ($_POST['___install']!==$_SESSION['___install']))) {
          $errorMessage='<div class="alert alert-danger">Error al validar el formulario.</div>';
          $dontInstall=true;
        }

        if(!$dontInstall and valid_pass($_POST['password'])) {
          $errorMessage='<div class="alert alert-danger">La contraseña debe contener minimo 8 acracteres, minusculas, mayusculas y numeros</div>';
          $dontInstall=true;
        }

        if(!$dontInstall and !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
          $errorMessage='<div class="alert alert-danger">Ingrese un email válido</div>';
          $dontInstall=true;
        }

        if(!$dontInstall) {
          $commands = file_get_contents($dbPathSql);
          $commands = strtr($commands,array(
            '{{{email}}}'=>$_POST['email'],
            '{{{username}}}'=>$_POST['username'],
            '{{{password}}}'=>sha1($_POST['password']),
            '{{{title}}}'=>$_POST['title'],
          ));

          $dbCreated=run_sql_file($commands,$conn);
          if($dbCreated['success']==0) {
              $errorMessage="Error en el sql a importar: <br>" . mysqli_error($conn);
            $contentInstall=install_exce($errorMessage);
          } else {
            session_destroy();
            header('location:admin');
          }
        }
      }
      $token = $_SESSION['___install'] = "R3t414pp___install".time().rand(1,100000);
      $contentInstall=install_config_form($errorMessage,$token);
    }
  } else {
    $contentInstall=install_error_connection($dbname,$username,$servername);
  }
  if($conn)
    mysqli_close($conn);
}
if(!file_exists($dbPath)) {

  if(isset($_GET['step']) and $_GET['step']==1) {
    $contentInstall=install_form();
  } else if(isset($_GET['step']) and $_GET['step']==2) {
    
    if(count($_POST)>0) {

      if((empty($_POST['host']) or empty($_POST['db']) or empty($_POST['username']))) { 
        $errorMessage='Por favor ingrese los datos de servidor, base de datos, usuario y contraseña en el caso que la contraseña sea diferente a vacío';
        $contentInstall=install_form(false,'Enviar',$errorMessage);
      } else {

        $servername = $_POST['host'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dbname = $_POST['db'];

        // Create connection
        $conn = @mysqli_connect($servername, $username, $password, $dbname);
        
        if(!$conn) { 
          $contentInstall=install_error_connection($dbname,$username,$servername);
        } else {

          $contentFile=strtr($dbConfigContent,array(
            '{{currentHost}}'=>$_SERVER['HTTP_HOST'],
            '{{host}}'=>$_POST['host'],
            '{{db}}'=>$_POST['db'],
            '{{username}}'=>$_POST['username'],
            '{{password}}'=>$_POST['password'],
          ));

          $file = @fopen($dbPath, "w");
          if(@fwrite($file, $contentFile)===false) {
            $token = $_SESSION['___install'] = "R3t414pp___install".time().rand(1,100000);
            $contentInstall=install_content_file($contentFile,$token);
          } else {
            $token = $_SESSION['___install'] = "R3t414pp___install".time().rand(1,100000);
            $contentInstall=install_config_form('',$token);
          }
          @fclose($file);
        }
        if($conn)
          mysqli_close($conn);
      }
    }
    
  } else {
    $contentInstall=install_welcome();
  }
}
if(!empty($contentInstall)) {
  echo render(array('content'=>$contentInstall));
  exit;
}