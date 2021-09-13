<?php
namespace App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Provider;
use App\Useraddress;
use App\Location;
use App\Bookings;
use App\Timeslots;
use App\Category;
use App\Subcategory;
use App\Providerschedules;
use App\Providerservices;
use DB;
use Mail;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Guzzle\Http\Exception\ServerErrorResponseException;
use Illuminate\Support\Facades\File;

class Imageupload{
	
    function imgupload($image, $path=null, $type=null)    
	{                
	
			$filesize = filesize($image);        
			$fileName = $image->getClientOriginalName();        
			$fileExtension = $image->getClientOriginalExtension();        
			if(!empty($type) && $type == 'image'){            
			$exts = ['jpg', 'jpeg', 'png', 'bmp', 'gif'];            
				if(!in_array(strtolower($fileExtension), $exts)){                
					return 'extension error';            
				}        
			}        
			
			$fileName = rand(11111, 99999) . '.' . $fileExtension;        
			$destinationPath = 'images';        
			if(!empty($path)){            
				$destinationPath = $path;            
					if(!File::isDirectory($destinationPath)){ 
					// If folders not found on path then create folders                 
						File::makeDirectory($destinationPath, 0777, true, true);            
					}   
			}
				
			$upload_success = $image->move($destinationPath, $fileName);        
			if($upload_success){            
					return $fileName;        
			}else{
					return 'error';
			}    
	}
}

