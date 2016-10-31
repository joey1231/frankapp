<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Libraries\Cpiapi;
use Response;
use App\Models\Components\Offer;
use App\Models\Components\OffersLog;

class CpiController extends Controller
{
     public function syncAppThis(){
    	$response = Cpiapi::syncoffer(5,'57fbbbe60f478f5a900ef965');
    	return $response;
    }
    public function index(Request $request){
    	$log = new OffersLog();
    	$page = isset($request->page) ? $request->page : 0;
        $logs =  $log->where('offer_id',5)->orderBy('id','DESC')->skip($page * 50)->paginate(50);

    	return view('cpi.index',array('logs' => $logs, 'request' => $request->all(),'page'=>'cpi'));
    }

    public function checkDeletedOffer(){
    	$response = Cpiapi::deleteSync(5,'57fbbbe60f478f5a900ef965');
    	return $response;
    
    }
}
