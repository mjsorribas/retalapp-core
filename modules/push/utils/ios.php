<?php

//namespace Push;

class iOS {

    public static function notify($token, $data, $config, $custom_parameters,$sound) {

	//public static function notify($token, $data, $custom_parameters,$sound) {
  
      // $debugLog = true;
        //CREATE THE CONNECTION
        $ctx = stream_context_create();
        //stream_context_set_option($ctx, 'ssl', 'local_cert', $config['cert']);
        //stream_context_set_option($ctx, 'ssl', 'passphrase', $config['pwd']);
        
       // stream_context_set_option($ctx, 'ssl', 'local_cert', Yii::app()->request->baseUrl."/uploads/".$config->ios_cert);
        stream_context_set_option($ctx, 'ssl', 'local_cert', dirname(__FILE__)."/../../../../uploads/".$config->ios_cert);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $config->ios_pwd);
        
        
        //dd($config);
        //OPEN CONNECTION TO THE APNS SERVER
        //$fp = stream_socket_client('ssl://' . $config['host'] . '', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
		$fp = stream_socket_client('ssl://' .$config->ios_host, $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
		/*$fp = stream_socket_client(
	'ssl://gateway.sandbox.push.apple.com:2195', $err,
	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);*/
        if (!$fp) 
        {
            if($debugLog == true){
                echo "ERROR ".$errcode.": ".$errstr."\n";
            }
            return false;
        }

        //CREATE THE PAYLOAD BODY Create the payload body
 /*       if ($sound){
			$body['aps'] = array(
				'alert' => array(
					'body' => $data['message'], //.uniqid(),
					'action-loc-key' => $data['action_key']
				),
				'sound' => $data['sound'],
				'badge' => $data['badge'],
				'extra' => $custom_parameters,
			);
		} else {
			$body['aps'] = array(
				'alert' => array(
					'body' => $data['message'], //.uniqid(),
					'action-loc-key' => $data['action_key']
				),
				'badge' => $data['badge'],
				'extra' => $custom_parameters,
			);
		}
        //ENCODE PAYLOAD AS JSON
        $payload = json_encode($body);

        //BUILD THE BINARY NOTIFICATION
        $msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
        //SEND TO THE SERVER
        $result = fwrite($fp, $msg, strlen($msg));

        if($debugLog == true){
        if (!$result)
            echo 'Message not delivered' . PHP_EOL;
        else
            echo 'Message successfully delivered' . PHP_EOL;
        }
        //CLOSE SERVER CONNECTION
        fclose($fp);
        unset($fp);*/
        
        $body['aps'] = array('badge' => 1, 'sound' => 'default', 'alert' => array('action-loc-key' => 'Open', 'body' => $data['message']));

		// Encode the payload as JSON
		$payload = json_encode($body);

		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;

		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));

		/*if (!$result)
			echo 'Message not delivered' . PHP_EOL;
		else
			echo 'Message successfully delivered' . PHP_EOL;
*/
		// Close the connection to the server
		fclose($fp);
        
        return $result;
    }

}
