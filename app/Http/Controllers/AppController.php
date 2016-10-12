<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests;
use App\Http\Libraries\Util;
use Response;
use App\Models\Components\Offer;
use App\Models\Components\OffersLog;
class AppController extends Controller
{
    
    public function syncAppThis(){
    	 set_time_limit(0);
    	$logs = array();
    	
    	$offers = Util::appThis();


    	foreach ($offers->offers as $key => $value) {
				//dd($value);
    		$get_offer = Util::getOffer(array('filters'=>array('name'=>array('EQUAL_TO'=>substr($value->name,0,40)),'advertiser_id'=>array('EQUAL_TO'=>3))));
    		if(isset($get_offer->data->rowset)){
    			if(count($get_offer->data->rowset) >0){
	    			$offer =array( 
			    			'offer'=>[
			    				'name'=>$value->name,
								'advertiser_id'=>3,
								'status'=>'active',
								'revenue'=>$value->campaigns[0]->payout,
								'payout'=>number_format($value->campaigns[0]->payout * 0.90, 2, '.', ''),
								'preview_url'=>"https://play.google.com/store/apps/details?id=".$value->android_package_name,
								'destination_url'=>$value->tracking_url."?clickid={click_id}&source={aff_id}&source2={source_id}",
								'description'=>$value->description,
								
								
			    			],
			    			'offer_category'=>array('name'=>implode(',',$value->categories)),
			    			'offer_geo'=>array('target'=>array()),
			    			
		    			
		    			);
	    			$country_code=array();
		    		foreach ($value->campaigns[0]->countries as $i => $country) {
		    			$country_code[]=$country;

		    			//$offer['offer_geo']['target'][] = array('country'=>$country,'type'=>1);
		    		}
		    		$countries = Util::getCountryName(implode(';',$country_code));
		    		foreach ($countries as $c => $country) {
		    			$offer['offer_geo']['target'][] = array('country'=>$country,'type'=>1);
		    		}
		    		
		    	$offer_look= Util::updateOffer($offer,$get_offer->data->rowset[0]->id);
		    	if($value->icon_url !=''){
		    		Util::thumbnail($value->icon_url,$get_offer->data->rowset[0]->id);
		    	}
		    	
    			if(Offer::where('advertiser_id',3)->where('offer_id',$value->id)->count() <=0){
    				try{
	    				$new_offer = new Offer;
				    	$new_offer->name=$value->name;				
				    	$new_offer->advertiser_id=3;
						$new_offer->offer_approval=1;
						$new_offer->pricing_type='CPI';
						$new_offer->revenue=$value->campaigns[0]->payout;
						$new_offer->payout=number_format($value->campaigns[0]->payout * 0.90, 2, '.', '');
						$new_offer->preview_url="https://play.google.com/store/apps/details?id=".$value->android_package_name;
						$new_offer->destination_url=$value->tracking_url."?clickid={click_id}&source={aff_id}&source2={source_id}";
						$new_offer->description=$value->description;
						$new_offer->cap_budget='10000';
						$new_offer->cap_click=9999999;
						$new_offer->cap_type=2;
						$new_offer->cap_conversion=10000;
						$new_offer->offers_look_id=$get_offer->data->rowset[0]->id;
						$new_offer->offer_id = $value->id;
						$new_offer->offer_category= json_encode($value->categories);
						$new_offer->save();
						$offers_log= new OffersLog();
						$offers_log->offer_id = $new_offer->id;
						$offers_log->message = $value->name. " Offer Created";
						$offers_log->save();
						$logs[]= array(
							 		'log'=>$offers_log,
							 		'offer'=>$new_offer
						);
   	
    				}catch(\exception $ex){

    				}
	    			
    			}else{
					try{
	    				$offer_update =Offer::where('advertiser_id',3)->where('offer_id',$value->id)->first();
		    			$offer_update->name=$value->name;				
						$offer_update->revenue=$value->campaigns[0]->payout;
						$offer_update->payout=$value->campaigns[0]->payout * 0.90;
						$offer_update->preview_url="https://play.google.com/store/apps/details?id=".$value->android_package_name;
						$offer_update->destination_url=$value->tracking_url;
						$offer_update->description=$value->description;
						$offer_update->offer_category= json_encode($value->categories);
						$offer_update->save();
						$offers_log= new OffersLog();
						$offers_log->offer_id = $offer_update->id;
						$offers_log->message = $value->name. " Offer Updated";
						$offers_log->save();
						$logs[]= array(
						 		'log'=>$offers_log,
						 		'offer'=>$offer_update
						 );
    				}catch(\exception $ex){

    				}
	    			
    				
    			}
    		}else{
    			$offer =array( 
    			'offer'=>[
    				'name'=>substr($value->name,0,40),
					'advertiser_id'=>3,
					'offer_approval'=>1,
					'pricing_type'=>'CPI',
					'status'=>'active',
					'revenue'=>$value->campaigns[0]->payout,
					'payout'=>number_format($value->campaigns[0]->payout * 0.90, 2, '.', ''),
					'preview_url'=>"https://play.google.com/store/apps/details?id=".$value->android_package_name,
					'destination_url'=>$value->tracking_url."?clickid={click_id}&source={aff_id}&source2={source_id}",
					'description'=>$value->description,
					
						
	    			],
	    			'offer_category'=>array('name'=>implode(',',$value->categories)),
	    			'offer_geo'=>array('target'=>array()),
	    			'offer_cap'=>array(
	    				'cap_budget'=>'10000',
						'cap_click'=>9999999,
						'cap_type'=>2,
						'cap_conversion'=>10000,
						'cap_timezone',
	    			)
	    			
    			);
    			$country_code=array();
		    		foreach ($value->campaigns[0]->countries as $i => $country) {
		    			$country_code[]=$country;

		    			//$offer['offer_geo']['target'][] = array('country'=>$country,'type'=>1);
		    		}
		    		$countries = Util::getCountryName(implode(';',$country_code));
		    		foreach ($countries as $c => $country) {
		    			$offer['offer_geo']['target'][] = array('country'=>$country,'type'=>1);
		    		}
		    		
    			$offer_look= Util::createOffer($offer);
    			if(isset($offer_look->data->error)){

    			}else{
    				try{
    					if($value->icon_url !=''){
				    		Util::thumbnail($value->icon_url,$offer_look->data->offer->id);
				    	}
	    				$new_offer = new Offer;
					    $new_offer->name= isset($value->name) ? $value->name :'';$value->name;				
					    $new_offer->advertiser_id=3;
						$new_offer->offer_approval=1;
						$new_offer->pricing_type='CPI';
						$new_offer->revenue=isset($value->campaigns) ? $value->campaigns[0]->payout:'';
						$new_offer->payout=isset($value->campaigns) ? $value->campaigns[0]->payout * 0.90 :'';
						$new_offer->preview_url=isset($value->campaigns) ? $value->campaigns :'';
						$new_offer->destination_url=isset($value->tracking_url) ? $value->tracking_url :'';
						$new_offer->description= isset($value->description) ? $value->description :'';
						$new_offer->cap_budget='10000';
						$new_offer->cap_click=9999999;
						$new_offer->cap_type=2;
						$new_offer->cap_conversion=10000;
						$new_offer->offers_look_id=$offer_look->data->offer->id;
						$new_offer->offer_id = isset($value->id) ? $value->id :'';
						$new_offer->offer_category= json_encode($value->categories);
						$new_offer->save();
						$offers_log= new OffersLog();
						$offers_log->offer_id = $new_offer->id;
						$offers_log->message = $value->name. " Offer Created";
						$offers_log->save();
						$logs[]= array(
								 		'log'=>$offers_log,
								 		'offer'=>$new_offer
						);
						
    				}catch(\exception $ex){

    				}
    				
    				}
    			
    			}
    		}
    		
		}
		return Response::json([
            'messages' => 'Successfully Sync AppThis',
            'logs' => $logs,
           
        ], 200, array(), JSON_PRETTY_PRINT);
    }
    public function index(Request $request){
    	$log = new OffersLog();
    	$page = isset($request->page) ? $request->page : 0;
        $logs = $log->skip($page * 50)->paginate(50);

    	return view('welcome',array('logs' => $logs, 'request' => $request->all(),'page'=>'order'));
    }
    public function uploadThumbnail(){
    	dd(Util::thumbnail('https://lh5.ggpht.com/bRIRN4Tqxhg1eaU9CZnGtCYzKF4hhIgTiloa9nWIGFtq3c3fdhqPtAEnsLRTTvRyA5Dm=w30',1));
    }
    public function counries(){
    	dd(Util::getCountryName('au;usa'));
    }

    public function checkDeletedOffer(){
    	set_time_limit(0);
    	//dd('adfg');
    	$offers =Util::getOffer(array('limit'=>10000,'filters'=>array('advertiser_id'=>array('EQUAL_TO'=>3))));
    	
    	$offers_this = Util::appThis();

    	foreach ($offers->data->rowset as $key => $offer) {
    		 $flag = false;
    		foreach ($offers_this->offers  as $c => $value) {
    			if(substr($value->name,0,40) == $offer->name){
    				$flag=true;
    				break;
    			}
    		}
    		if($flag==false){
    			$params =array( 
    			'offer'=>[
    					'status'=>'deleted'
	    			]
	    			
	    			
    			);
    		
    			$offer_look= Util::updateOffer($params,$offer->id);
    			
				$offers_log= new OffersLog();
				$offers_log->offer_id = 0;
				$offers_log->message = $value->name. " Offer DLETED";
				$offers_log->save();	
    		}
    		
    	}

    	return Response::json([
            'messages' => 'Successfully Sync AppThis',
           
           
        ], 200, array(), JSON_PRETTY_PRINT);
    
    }
}
