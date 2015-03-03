<?php

//namespace Push;

class Android {

    public static function notify($token, $data, $config, $custom_parameters) 
   // public static function notify($token, $data, $custom_parameters) 
    {

        $fields = array(
            'data' => $data,
            'extra' => $custom_parameters
        );
        $fields['data']['extra'] = $custom_parameters;
        $headers = array(
            'Authorization: key=' . $config->android_api_key,
            'Content-Type: application/json'
        );
        //dd($fields);
        //OPEN CONNECTION
        $ch = curl_init();

        //SET URL, HEADERS AND OPTION
        curl_setopt($ch, CURLOPT_URL, $config->android_host);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //DISABLE SSL VERIFICATION
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $fields['registration_ids'] = (array)$token;
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        //EXECUTE CURL
        $result = curl_exec($ch);
        Yii::log($result ,'error','cron');
        //CLOSE CONNECTION
        
        $error = curl_error($ch);
        curl_close($ch);
        return empty($error);
    }

}
