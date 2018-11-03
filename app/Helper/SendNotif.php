<?php
namespace App\Helper;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;


class SendNotif{
 	
 	public static function sendNotifikasi($token){

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('Notifikasi');
        $notificationBuilder->setBody('Petugas Pemadam Kebakaran Sedang Menuju Lokasi Anda !')
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // $token = ;

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
 		
     //    $payload = array();
     //    $payload['team'] = 'indonesia';
     //    $payload['score'] = '5.6';

     //    $res = array();
     //    $res['data']['title'] = $pengirim;
     //    $res['data']['is_background'] = false;
     //    $res['data']['message'] = $isi;
     //    $res['data']['image'] = "http://156.67.217.19/disposisi.png";
     //    $res['data']['payload'] =  $payload;
     //    $res['data']['timestamp'] = date('Y-m-d G:i:s');
       
	    // $optionBuiler = new OptionsBuilder();
	    // $optionBuiler->setTimeToLive(60*20);

	    // $notificationBuilder = new PayloadNotificationBuilder($pengirim);
	    // $notificationBuilder->setBody($isi)->setSound('default');

	    // $dataBuilder = new PayloadDataBuilder();
	    //  $dataBuilder->addData($res);

	    // $option = $optionBuiler->build();
	    // $notification = $notificationBuilder->build();
	    // $data = $dataBuilder->build();

	    // $downstreamResponse = FCM::sendTo($tujuan, $option, null, $data);  
    }

    public static function sendTopic($title,$body,$topic)
    {
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                            ->setSound('default');

        $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic('global');

        $topicResponse = FCM::sendToTopic($topic, null, $notification, null);

        $topicResponse->isSuccess();
        $topicResponse->shouldRetry();
        $topicResponse->error();
    }

   
}