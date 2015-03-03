<?php

//use Push\Android;
//use Push\iOS;
include dirname(__FILE__)."/android.php";
include dirname(__FILE__)."/ios.php";
class Notifier {

	public static function notify($uuid, $type, $message, $custom_parameters,$sound,$badge)
	{
        
        $model=PushConfig::model()->findByPk(1);

         //Yii::log($model->activo. ' '.$model->android_api_key ,'error','Model');

        if($model != null && ($model->activo === 1 || $model->activo === "1")) {
          //if($model != null){
            if ($type === 2 || $type === '2')
            {
               //Yii::log('Android','error','cron');
                if ($model->android_api_key != null && $model->android_api_key != '' && 
                    $model->android_host != null && $model->android_host != ''  ){
                    return Notifier::android($uuid, $message, $custom_parameters,$sound,$model);
                }
            }
            else
            {
                if ($model->ios_pwd != null && $model->ios_pwd != '' && 
                    $model->ios_cert != null && $model->ios_cert != '' && 
                    $model->ios_host != null && $model->ios_host != ''){
                  // Log::warning('IOS');
                  //Yii::log('Iphone','error','cron');
                   return Notifier::iOS($uuid, $message, $custom_parameters,$sound,$badge,$model);
                }
            }
        } else {
            return 'No esta Activo';
        }
        return "No entro en nada";
	}

/*
    public static function notifyAll($message, $custom_parameters,$sound,$badge)
    {
        $cantidad_enviada = 0;

        $model=PushConfig::model()->find();
        Yii::log(print_r($model->activo ,1),'error','cron');
        if($model != null && ($model->activo === 1 || $model->activo === '1')) {
            
           
            $devices = PushMobiles::model()->findAll();   

            Yii::log(print_r($devices ,1),'error','push');
            foreach ($devices as $device) {
                
                Yii::log('Android','error','cron');
                Yii::log(print_r($device,1),'error','cron');
            
                if ($device->device_type === 2 || $device->device_type === '2')
                {
                   //Yii::log('Android','error','cron');
                    if ($model->android_api_key != null && $model->android_api_key != '' && 
                        $model->android_host != null && $model->android_host != ''  ){
                        $respuesta = Notifier::android($device->uuid, $message, $custom_parameters,$sound,$model);
                        Yii::log($respuesta ,'error','cron');
                        $cantidad_enviada = $cantidad_enviada + 1;
                    }
                }
                else
                {
                    if ($model->ios_pwd != null && $model->ios_pwd != '' && 
                        $model->ios_cert != null && $model->ios_cert != '' && 
                        $model->ios_host != null && $model->ios_host != ''){
                      // Log::warning('IOS');
                      //Yii::log('Iphone','error','cron');
                      Notifier::iOS($device->uuid, $message, $custom_parameters,$sound,$badge,$model);
                        $cantidad_enviada = $cantidad_enviada + 1;
                    }
                }
            }
        }
    }

*/
	protected static function iOS($uuid, $message, $custom_parameters = array(),$sound,$badge,$config)
	{
		//$config = Config::get('push');
       // $config =  $config['ios'];
        
        $data['message']    = $message['message'] ;
        $data['badge']      = $badge;
        if($sound){
			$data['sound']      = 'default';
		}
        $data['action_key'] = 'Open';

        // return iOS::notify($uuid, $data, $config, $custom_parameters,$sound);

        if(is_array($uuid)){
            foreach ($uuid as $keyToken => $valueToken) {
               iOS::notify($valueToken, $data, $config, $custom_parameters,$sound);
               //  iOS::notify($valueToken, $data, $custom_parameters,$sound);
            }
            return true;
        }else{
            return iOS::notify($uuid, $data, $config, $custom_parameters,$sound);
            //return iOS::notify($uuid, $data, $custom_parameters,$sound);
        }
	}
    	
	/*
    protected static function android($uuid, $message)
	{
        $config = Config::get('push');
        $config =  $config['android'];

        $data['message']    = json_encode($message);
        $data['badge']      = 1;
        $data['sound']      = 'default';
        $data['action_key'] = 'Open';

        return Android::notify($uuid, $data, $config, array());
	}
    */
    protected static function android($tokens, $message = 'Laravel Push Notification', $custom_parameters = array(),
                                         $sound, $config)
    {

        $badge = 1; 
        $sound = 'default'; 
        $action_key = 'Open';
        
        //$config = Config::get('push');
        //$config =  $config['android'];

        $tokens = $tokens;//(array)$tokens;

        $data['message']    = $message;
        $data['badge']      = $badge;
        if ($sound){
			$data['sound']      = $sound;
		}
        $data['action_key'] = $action_key;

        return Android::notify($tokens, $data, $config, $custom_parameters);
		//return Android::notify($tokens, $data, $custom_parameters);

    }
}
