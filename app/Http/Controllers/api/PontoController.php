<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PontoController extends Controller
{
    public function ponto(Request $request){
    	$latitude = $request->input("latitude");
    	$longitude = $request->input("longitude");
    	//-23.5264093
    	//-46.6664467

    	if(empty($latitude) or empty($longitude)){
    		return response([
            'status' => 'error',
            'erro' => 'Insira latitude e longitude'
        	]);
    	}

    	$endpoint = "https://us1.locationiq.com/v1/reverse.php?key=43706011dbee3d&lat=".$latitude."&lon=".$longitude."&format=json";
    	$ch = curl_init();
     	curl_setopt($ch, CURLOPT_URL, $endpoint);
    	curl_setopt($ch, CURLOPT_POST, 0);
     	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($ch);
	    $err = curl_error($ch);  //if you need
	    curl_close ($ch);
	     
    	 return response([
            'status' => 'success',
            'json' => json_decode($response)
            
        ]);
    }
}
