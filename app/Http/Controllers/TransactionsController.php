<?php



namespace App\Http\Controllers;

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use App\Pesapal\Pesapal;
use App\Transactions;
use App\User;
use App\Provider;
use DB;



class TransactionsController extends PaymentController {
    

	public function notify(Request $request) {
        $params = $request->all();
        $pesapal_tracking_id 		= $params['pesapal_transaction_tracking_id'];
		$pesapal_merchant_reference = $params['pesapal_merchant_reference'];
		$amount 					= $params['amount'];
		$user_id 					= $params['user_id'];
		$type 						= $params['type'];
		
		
		//print_r($params);
		
		$p = new Pesapal();
		$inquiryStatus = $p->redirectToIPN('CHANGE',$pesapal_merchant_reference,$pesapal_tracking_id);
		
		/*
		echo 'user_id='.$user_id;
		echo '<br>';
		echo 'pesapal_tracking_id='.$pesapal_tracking_id;
		echo '<br>';
		echo 'pesapal_merchant_reference=' . $pesapal_merchant_reference;
		echo '<br>';
		echo 'amount=' . $amount;
		echo '<br>';
		echo 'status=' . $inquiryStatus['status'];
		echo '<br>';
		echo 'payment_method=' . $inquiryStatus['payment_method'];
		*/
		
		if($type == 'user')
			$userdetails = User::where('id', $user_id)->first();
		else 
			$userdetails = Provider::where('id', $user_id)->first();
				
		
		
		$transactions = new Transactions();
		$transactions->userid 		= $user_id;
		$transactions->first_name 	= $userdetails->first_name;
		$transactions->last_name 	= $userdetails->last_name;
		$transactions->email 		= $userdetails->email;
		$transactions->amount 		= $amount;
		$transactions->reference_id = $pesapal_merchant_reference;
		$transactions->principal_transaction_id = $pesapal_tracking_id;
		$transactions->status = $inquiryStatus['status'];
		$transactions->principal_name = 'PESAPAL';
		$transactions->payment_method = $inquiryStatus['payment_method'];
		$transactions->type = $type;
		
		$transactions->save();
		
		return view('frontend.transaction-notify',
		['transaction'	=>	$transactions,
		 'halo' 		=>	'Halo!!!!!!'
		]);
		
		
    }
	
	
	
	public function lists(){
		
		 $transactions = DB::table('transactions')->get();

        if ($transactions) {
            $response['error'] = 'false';
            $response['error_message'] = 'success';
            $response['list_transactions'] = $transactions;
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'no transaction available';
            $response['list_transactions'] = [];
        }
        echo json_encode($response);
		
		
	}

    

	public function byuser(Request $request){
		 $user_id 	= $request->user_id;
		
		 if($request->has('type'))
			$type = $request->type;		
		 else 
			$type = 'user';
		 
		
		
		 $transactions = Transactions::where('userid', $user_id)
						->where('type', $type)
						//->where('status', 'SUCCESS')
						->orderBy('id', 'desc')->get();

        if ($transactions) {
            $response['error'] = 'false';
            $response['error_message'] = 'success';
            $response['list_transactions'] = $transactions;
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'no transaction available';
            $response['list_transactions'] = [];
        }
        echo json_encode($response);
		
		
	}



	public function getbalancebyuser(Request $request){
		$user_id = $request->user_id;
		if($request->has('type'))
			$type = $request->type;		
		 else 
			$type = 'user';
		 
		
		
		$amount = Transactions::where('userid', $user_id)
		->where('type', $type)
		//->where('status', 'SUCCESS')
		->sum("amount");
           
		$response = []; 
	    if ($amount) {
                $response['error'] = 'false';
                $response['error_message'] = 'success';
                $response['amount'] = $amount;
        } else {
                $response['error'] = 'false';
                $response['error_message'] = 'There is no such balance for current user';
                $response['amount'] = 0;
        }
		
		echo json_encode($response);

	
	}
    

    public function detail(Request $request){
		$transaction_id = $request->id;
		$transaction = Transactions::where('id', $transaction_id)->first();
           
		$response = []; 
	    if ($transaction) {
                $response['error'] = 'false';
                $response['error_message'] = 'success';
                $response['transaction_details'] = $transaction;
        } else {
                $response['error'] = 'true';
                $response['error_message'] = 'nodetails';
                $response['transaction_details'] = [];
        }
		
		echo json_encode($response);

	
	}
    

}

