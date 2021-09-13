<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesapal\Pesapal;
use App\Transactions;
use App\User;
use App\Provider;


class PaymentController extends Controller {

     public function makePayment(Request $request){
		 /*
         $user_id = 349;
		 $amount  = 10;
		 */
		 $user_id = $request->user_id;
		 $amount  = $request->amount;
		 $type	  = $request->type;
		 
		 if($type != null && $type == 'provider'){
			$userdetails = Provider::where('id', $user_id)->first();
        }else {
			$type = 'user';
			$userdetails = User::where('id', $user_id)->first();
         }
		 
		
		 
		 $first_name  	= $userdetails->first_name;
		 $last_name  	= $userdetails->last_name;
		 $email  		= $userdetails->email;
		 $phoneNumber   = $userdetails->mobile;
		 $descriptions  = 'Payment from www.ReadiWork.com';
		 
		 
		 $p = new Pesapal();
		 $params = [ // the defaults will be overidden if set in $params
                      'amount' 			=> $amount,
                      'description'	 	=> $descriptions,
                      'type' 			=> 'MERCHANT',
                      'first_name' 		=> $first_name,
                      'last_name' 		=> $last_name,
                      'email' 			=> $email,
					  'phonenumber' 	=> $phoneNumber,
        ];

		 
		 
         $p->setUserId($user_id);
		 $p->setUserType($type);
		 echo $p->makePayment($params);

     }
    

     public function inquiry(){ 
		 $pesapal_notification 			= 'CHANGE';
		 $pesapal_Tracking_id 			= '1fb7bc21-4ace-455c-b0e1-05410aec078e';
		 $pesapal_merchant_reference 	= 'READIWORKJF3CGFQFHZAMMA';
		 
		 $p = new Pesapal();
		 $status = $p->redirectToIPN($pesapal_notification,$pesapal_merchant_reference, $pesapal_merchant_reference);
		 //print_r($status);
		 
	 }





}

