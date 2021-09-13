<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Parties;
use DB;



class PartiesController extends Controller {
     
	
	
	public function lists(){
		
		 $parties = DB::table('parties')->get();

        if ($parties) {
            $response['error'] = 'false';
            $response['error_message'] = 'success';
            $response['list_parties'] = $parties;
        } else {
            $response['error'] = 'true';
            $response['error_message'] = 'no transaction available';
            $response['list_parties'] = [];
        }
        echo json_encode($response,JSON_UNESCAPED_SLASHES);
		
		
	}

     

}

