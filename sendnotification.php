<?php
function sendGCM($registrationIds, $message) {

 #API access key from Google API's Console
    define( 'API_ACCESS_KEY', 'AAAAU6fXwdA:APA91bEpsipBfRwRV231HMOyxlSuRziAZwP03rmIPSUQlSIIVJdqDdtWsNSh8oZoXZXEnmKljfNNKugF-iQ7-EV7xQWKuz-vMCo-yHfhYZGKMrAOnPu2B_jSFgzfo9JGzIC_i5ixVwKI' );
#prep the bundle
     $msg = array
          (
        'body'  =>  $message,
        'title' => 'Station failure',
        'sound'=> 'default'
          );
    $fields = array
            (
                'to'        => $registrationIds,
                'notification'  => $msg,
                'priority'  => "high"
                
                
            );


    $headers = array
            (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );
#Send Reponse To FireBase Server    
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        echo $result = curl_exec($ch);
        curl_close( $ch );
#Echo Result Of FireBase Server
return $result;
}
//AAAAU6fXwdA:APA91bEpsipBfRwRV231HMOyxlSuRziAZwP03rmIPSUQlSIIVJdqDdtWsNSh8oZoXZXEnmKljfNNKugF-iQ7-EV7xQWKuz-vMCo-yHfhYZGKMrAOnPu2B_jSFgzfo9JGzIC_i5ixVwKI
?>
