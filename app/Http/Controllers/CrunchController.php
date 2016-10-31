<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Libraries\Crunchiemedia;
use Response;
use App\Models\Components\Offer;
use App\Models\Components\OffersLog;
class CrunchController extends Controller
{
      public function syncAppThis(){
    	$response = Crunchiemedia::syncoffer(7,'9c31cbea6494bf89da236237f7b6f6a5');
    	return $response;
    }
    public function index(Request $request){
    	$log = new OffersLog();
    	$page = isset($request->page) ? $request->page : 0;
        $logs =  $log->where('offer_id',7)->orderBy('id','DESC')->skip($page * 50)->paginate(50);

    	return view('crunch.index',array('logs' => $logs, 'request' => $request->all(),'page'=>'crunch'));
    }

    public function checkDeletedOffer(){
    	$response = Crunchiemedia::deleteSync(7,'9c31cbea6494bf89da236237f7b6f6a5');
    	return $response;
    
    }
  }
