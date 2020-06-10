<?php
namespace App\Helper;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;


class SendNotif{
 	
 	public static function sendNotifikasi($token, $jenis){

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('Notifikasi');
        if($jenis == 1){ 
            $notificationBuilder->setBody('Petugas Pemadam Kebakaran Sedang Menuju Lokasi Anda !')
                            ->setSound('default');
        }
        else{
            $notificationBuilder->setBody('Laporan Anda Telah DiTolak, Karena Informasi Kurang Jelas !!')
                            ->setSound('default');
        }

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

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

    public static function sendInfo($token, $jarak, $waktu){

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('Notifikasi');
        $notificationBuilder->setBody('Jarak Lokasi Kebakaran Dengan Kantor Pemadam Kebakaran '.$jarak.' . Petugas Pemadam Kebakaran Akan Sampai Dalam Waktu '.$waktu)
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
 		
    }

   
}