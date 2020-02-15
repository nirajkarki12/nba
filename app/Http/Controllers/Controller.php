<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function curlRequest($url, $method) {
    	try {
    		
	    	$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CUSTOMREQUEST => $method,
				));

				$response = curl_exec($curl);
				if($err = curl_error($curl)) throw new \Exception($err, 1);
				
				curl_close($curl);

				return json_decode($response, true);

			} catch (\Exception $e) {
    		throw new \Exception($e->getMessage(), 1);
    		
    	}
    }
}
