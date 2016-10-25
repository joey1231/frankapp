<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Libraries\Util;
use App\Http\Libraries\Hasoffer;
use Response;
use App\Models\Components\Offer;
use App\Models\Components\OffersLog;
class WadogoController extends Controller
{
   public function syncAppThis(){
    	$response = Hasoffer::syncoffer(11,'wadogo','21bb55a10d1f26ac9d2ee9df47bfc3d07e726802bc0ed206e9d93784604e2c20');
    	return $response;
    }
    public function index(Request $request){
    	$log = new OffersLog();
    	$page = isset($request->page) ? $request->page : 0;
        $logs =  $log->where('offer_id',11)->skip($page * 50)->paginate(50);

    	return view('wadogo.index',array('logs' => $logs, 'request' => $request->all(),'page'=>'wadogo'));
    }

    public function checkDeletedOffer(){
    	$response = Hasoffer::deleteSync(11,'wadogo','21bb55a10d1f26ac9d2ee9df47bfc3d07e726802bc0ed206e9d93784604e2c20');
    	return $response;
    
    }
}
