<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Libraries\Util;
use App\Http\Libraries\Adexperience;
use Response;
use App\Models\Components\Offer;
use App\Models\Components\OffersLog;
class AdexperienceController extends Controller
{
     public function syncAppThis(){
    	$response = Adexperience::syncoffer(9,'af28b0c871b34bc295c67ae05f327c54580086a83ff19 ');
    	return $response;
    }
    public function index(Request $request){
    	$log = new OffersLog();
    	$page = isset($request->page) ? $request->page : 0;
        $logs =  $log->where('offer_id',9)->orderBy('id','DESC')->skip($page * 50)->paginate(50);

    	return view('adexperience.index',array('logs' => $logs, 'request' => $request->all(),'page'=>'adexperience'));
    }

    public function checkDeletedOffer(){
    	$response = Adexperience::deleteSync(9,'af28b0c871b34bc295c67ae05f327c54580086a83ff19 ');
    	return $response;
    
    }
}
