<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Libraries\Util;
use App\Http\Libraries\Hasoffer;
use Response;
use App\Models\Components\Offer;
use App\Models\Components\OffersLog;

class OneApiController extends Controller
{
    public function syncAppThis(){
    	$response = Hasoffer::syncoffer(10,'tyrooone','17c40f22d2f1c3712e1d01a7e877cf698eb8804f0c330dc6c7dbe9b1ca295c77');
    	return $response;
    }
    public function index(Request $request){
    	$log = new OffersLog();
    	$page = isset($request->page) ? $request->page : 0;
        $logs = $log->where('offer_id',10)->orderBy('id','DESC')->skip($page * 50)->paginate(50);

    	return view('one-api.index',array('logs' => $logs, 'request' => $request->all(),'page'=>'oneapi'));
    }

     public function checkDeletedOffer(){
    	$response = Hasoffer::deleteSync(10,'tyrooone','17c40f22d2f1c3712e1d01a7e877cf698eb8804f0c330dc6c7dbe9b1ca295c77');
    	return $response;
    
    }
}
