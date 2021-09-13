<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $message
     * @param mixed $data
     *
     * @return array
     *
     * Created by VDM
     */
    public function makeResponse($message = '', array $data = [])
    {
        return [
            'success' => true,
            'data' => $data,
            'message' => $message
        ];
    }

    /**
     * @param string $message
     * @param array $data
     *
     * @return array
     *
     * Created by VDM
     */
    public function makeError($message = '', array $data = [])
    {
        $res = [
            'success' => false,
            'message' => $message
        ];
        if (!empty($data)) {
            $res['data'] = $data;
        }
        return $res;
    }

    /**
     * @param $to
     * @param $body
     *
     * Created by VDM
     */
    public function sendSms($body, $to)
    {
	    $authToken = config('services.twilio.auth_token');
        $accountSid = config('services.twilio.account_sid');
        $sender = config('services.twilio.number');
       /*
	    echo "hai = " . $authToken . " ". $accountSid . " " . $sender;
		echo "<br>";
		echo "body=" . $body . " - to=" . $to;
		die;
    */
	
		$client = new Client($accountSid, $authToken);
        try {
            $send = $client->messages->create(
                $to,
                array(
                    'from' => $sender,
                    'body' => $body
                )
            );
            
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
		
    }

    /**
     * @return int
     *
     * Created by VDM
     */
    public function otpGenerator()
    {
        return rand(100000, 999999);
    }

    public function sendPushNotification($recipients, $main_title, $body, $otherData = '', $title = 'Peepalike',$badge)
    {

        try {
            $notification = array(
                'title' => $title,
                'body' => $body,
                'data' => $otherData,
                'main_title' => $main_title,
                "sound" => "default",
                'badge' => $badge
            );

            // if($otherData != ""){
            //     $parameters = json_decode($otherData);
            //     foreach ($parameters as $key => $value) {
            //         $notification[$key] = $value;
            //     }
            // }

            $fcmResult = fcm()
                ->to($recipients)//$recipients must an array
                ->data($notification)
                ->notification($notification)
                ->send();
                
            return $fcmResult;
        } catch (\Throwable $th) {
            return array();
        }
    }
	
	
	
	 
	
}
