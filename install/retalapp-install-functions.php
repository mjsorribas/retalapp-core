<?php
function valid_pass($candidate) {
   $r1='/[A-Z]/';  //Uppercase
   $r2='/[a-z]/';  //lowercase
   $r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
   $r4='/[0-9]/';  //numbers

   if(preg_match_all($r1,$candidate, $o)<2) return false;

   if(preg_match_all($r2,$candidate, $o)<2) return false;

   if(preg_match_all($r3,$candidate, $o)<2) return false;

   if(preg_match_all($r4,$candidate, $o)<2) return false;

   if(strlen($candidate)<8) return false;

   return true;
}
function render($_params_=null) {
    if(is_array($_params_))
        extract($_params_,EXTR_PREFIX_SAME,'params');
    else
        $params=$_params_;
    ob_start();
    ob_implicit_flush(false);
    require(dirname(__FILE__).'/retalapp-install-layout.php');
    return ob_get_clean();
}
function install_config_form($errorMessage='',$token='') {

    $defaultValue='';
    $contentInstall='
        <h1>Hola</h1>
        <p>¡Bienvenido al famoso proceso de instalación de WordPress en cinco minutos! Simplemente completa la información siguiente y estarás a punto de usar la más enriquecedora y potente plataforma de publicación personal del mundo.</p>
        '.$errorMessage.'
        <h1>Información necesaria</h1>
        <p>Por favor, debes facilitarnos los siguientes datos. No te preocupes, siempre podrás cambiar estos ajustes más tarde.</p>
        <p><form class="form-horizontal" method="post" action="?step=3">
          <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Título del sitio</label>
            <div class="col-sm-6">
              <input value="'.((isset($_POST['title']))?($_POST['title']):'').'" name="title" type="text" class="form-control" id="title" placeholder="">
            </div>
          </div>
          
          <div class="form-group">
            <label for="username" class="col-sm-3 control-label">Nombre de usuario</label>
            <div class="col-sm-6">
              <input value="'.((isset($_POST['username']))?($_POST['username']):'').'" name="username" type="text" class="form-control" id="username" placeholder="">
            <em>Los nombres de usuario pueden tener únicamente caracteres alfanuméricos, espacios, guiones bajos, guiones medios, puntos y el símbolo @.</em>
            </div>
          </div>
          
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Contraseña</label>
            <div class="col-sm-6">
              <input value="'.((isset($_POST['password']))?($_POST['password']):'').'" name="password" type="text" autocomplete="off" value="'.$defaultValue.'" class="form-control" id="password" placeholder="">
            <em><strong>Importante:</strong> Necesitas esta contraseña para acceder. Por favor, guárdala en un lugar seguro.</em>
            </div>
          </div>
          
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Tu correo electrónico</label>
            <div class="col-sm-6">
              <input value="'.((isset($_POST['email']))?($_POST['email']):'').'" name="email" type="text" class="form-control" id="email" placeholder="">
            <em>Comprueba bien tu dirección de correo electrónico antes de continuar.</em>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
              <div class="checkbox">
                <label>
                  <input name="page_public" value="1" checked="checked" type="checkbox"> Privacidad: Permitir a los buscadores que indexen el sitio
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
              <input name="___install" value="'.$token.'" type="hidden">
              <button type="submit" class="btn btn-default">Instalar Retalapp</button>
            </div>
          </div>
        </form>
        </p>
    ';
    return $contentInstall; 
}
function install_exce($message) {
    $contentInstall='<p>'.$message.'</p>';
    return $contentInstall;
}
function install_content_file($contentFile='',$token='') {
    $contentInstall='
        <p>Lo siento, pero no puedo escribir en el archivo <code>app/config/database.php</code>.</p>
        <p>Puedes crear manualmente el arhivo <code>app/config/database.php</code> y pegar el siguiente texto en el.</p>
        <textarea class="form-control" id="retalapp-config" style="width:100%" rows="15" class="code">'.$contentFile.'</textarea>
        <p>Después de hacer esto haz clic en “Ejecutar la instalación.”</p>
        <p class="step">
            '.install_form(true,'Ejecutar la instalación','','step=3',$token).'
        </p>
        <p><a href="?step=1">Volver a configurar los datos de conexión</a></p>
    ';
    return $contentInstall;
}
function install_error_connection($db='',$username='',$host='')
{
    $contentInstall='
        <h1>Se ha producido un error al intentar establecer una conexión con la base de datos</h1>
        <p>Esto puede significar que la información sobre el nombre de usuario y la contraseña que contiene tu archivo <code>app/config/database.php</code> es incorrecta, o bien que no ha sido posible conectar con el servidor de la base de datos en <code>'.$host.'</code>. La causa podría ser que el host de la base de datos esté caído.</p>
        <ul>
        →<li>¿Estás seguro de que el nombre de usuario y la contraseña son correctos?</li>
        →<li>¿Estás seguro de haber escrito correctamente el hostname?</li>
        →<li>¿Estás seguro que el servidor de la base de datos funciona correctamente?</li>
        →<li>¿Seguro que existe la base de datos <code>'.$db.'</code>?</li>
        →<li>¿Tiene permiso el usuario <code>'.$username.'</code> para usar la base de datos <code>'.$db.'</code>?</li>
        </ul>
        <p>Si no sabes con seguridad qué significan algunas de las preguntas anteriores te aconsejamos contactar con la empresa donde tengas contratado tu alojamiento. Si aun después de hacerlo necesitas ayuda puedes probar a visitar el <a href="http://retalapp.org/questions">foro de ayuda de Retalapp</a>.</p>
        <p></p><p class="step">

        <a href="?step=1" onclick="javascript:history.go(-1);return false;" class="btn btn-default">Inténtalo de nuevo</a>
        </p>
    ';
    return $contentInstall;
}
function install_welcome()
{
    $contentInstall='<p>Bienvenido a Retalapp. Antes de empezar necesitamos alguna información de la base de datos. Necesitarás saber lo siguiente antes de continuar.</p>';
    $contentInstall.='<ol>
        <li>Nombre de la base de datos</li>
        <li>Usuario de la base de datos</li>
        <li>Contraseña de la base de datos</li>
        <li>Servidor de la base de datos</li>       
    </ol>';
    $contentInstall.='<p>
    Vamos a utilizar esta información para crear el archivo <code>app/config/database.php</code>.   <strong>Si por cualquier motivo la creación automática del archivo no funciona no te preocupes. Lo que hace este proceso es rellenar un fichero de configuración con la información de la base de datos. También puedes simplemente abrir el archivo <code>app/config/database.sample.php</code> en un editor de texto, rellenarlo con tu información, y guardarlo como <code>app/config/database.php</code></strong>
    <!-- ¿Necesitas más ayuda? <a href="">La tenemos</a>. -->
    </p>';
    $contentInstall.='<p>Con toda probabilidad, tu alojamiento web te ha dado la información de estos elementos. Si no tienes esta información, necesitarás contactar con ellos antes de continuar. Si estás listo, …</p>';
    $contentInstall.='<p class="step"><a href="?step=1" class="btn btn-default">¡Vamos a ello!</a></p>';
    return $contentInstall;
}
function install_form($hidden=false,$buttonText='Enviar',$errorMessage='',$action='step=2',$token='')
{
    $contentInstall='';
    if(!empty($errorMessage))
        $contentInstall.='<div class="alert alert-danger">'.$errorMessage.'</div>';
    if(!$hidden) {
        $contentInstall.='<p>A continuación deberás introducir los detalles de conexión a tu base de datos. Si no estás seguro de esta información contacta con tu proveedor de alojamiento web.</p>';
    }
    $contentInstall.='<form method="post" action="?'.$action.'" class="form-horizontal">';
    if($hidden) {
        $contentInstall.='<input value="'.((isset($_POST['host']))?($_POST['host']):'').'" type="hidden" name="host">';
        $contentInstall.='<input value="'.((isset($_POST['db']))?($_POST['db']):'').'" type="hidden" name="db">';
        $contentInstall.='<input value="'.((isset($_POST['username']))?($_POST['username']):'').'" type="hidden" name="username">';
        $contentInstall.='<input value="'.((isset($_POST['password']))?($_POST['password']):'').'" type="hidden" name="password">';
        if(!empty($token)) {
            $contentInstall.='<input value="'.$token.'" type="hidden" name="___token">';
        }
        $contentInstall.='<div class="form-group">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-default">'.$buttonText.'</button>
            </div>
          </div>
    ';
    } else {

    $contentInstall.='<div class="form-group">
                        <label for="db" class="col-sm-3 control-label">Nombre de la base de datos</label>
                        <div class="col-sm-5">
                          <input type="text" value="'.((isset($_POST['db']))?($_POST['db']):'retalapp_proyect').'" name="db" class="form-control" id="db" placeholder="">
                        </div>
                        <div class="col-sm-4">
                            <span>El nombre de la base de datos en la que quieres ejecutar Retalapp.</span>
                        </div>
                  </div>';
        $contentInstall.='<div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Nombre de usuario</label>
                        <div class="col-sm-5">
                          <input type="text" value="'.((isset($_POST['username']))?($_POST['username']):'root').'" name="username" class="form-control" id="username" placeholder="">
                        </div>
                        <div class="col-sm-4">
                            <span>Tu usuario de MySQL</span>
                        </div>
                  </div>';
        $contentInstall.='<div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Contraseña</label>
                        <div class="col-sm-5">
                          <input type="text" value="'.((isset($_POST['password']))?($_POST['password']):'').'" name="password" class="form-control" id="password" placeholder="">
                        </div>
                        <div class="col-sm-4">
                            <span>…y tu contraseña de MySQL.</span>
                        </div>
                  </div>';

        $contentInstall.='<div class="form-group">
                        <label for="server" class="col-sm-3 control-label">Servidor de la base de datos</label>
                        <div class="col-sm-5">
                          <input type="text" value="'.((isset($_POST['host']))?($_POST['host']):'localhost').'" name="host" class="form-control" id="server" placeholder="">
                        </div>
                        <div class="col-sm-4">
                            <span>Deberías poder acceder desde tu servidor web si localhost no funciona.</span>
                        </div>
                  </div>';
        
        $contentInstall.='<div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-default">'.$buttonText.'</button>
                    </div>
                  </div>
                ';
    }
    $contentInstall.='</form>';
    return $contentInstall;
}

// Here's a startsWith function
function startsWith($haystack, $needle){
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function run_sql_file($commands,$conn){
    //load file
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
    $commands = explode(";\n", $commands);
    // var_dump($commands);
    // exit;
    // $commands = array($commands);
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