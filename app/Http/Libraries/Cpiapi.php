<?php

namespace App\Http\Libraries;

use Illuminate\Http\Request;

use App\Http\Requests;
use anlutro\cURL\cURL;
use App\Http\Libraries\Util;
use Response;
use App\Models\Components\Offer;
use App\Models\Components\OffersLog;
class Cpiapi 
{
	public static function syncoffer($id,$api){
	 set_time_limit(0);
	 $logs = array();
    	
    	$offers = self::getOffer($api);


    	foreach ($offers->offers as $key => $value) {
    		

    		$get_offer = Util::getOffer(array('filters'=>array('name'=>array('EQUAL_TO'=>substr($value->name,0,40)),'advertiser_id'=>array('EQUAL_TO'=>$id))));
    		$payout = $value->cpi;
    		//sleep(1);
    		
    		$thumbnail_link = $value->icon;

    		$country_code=array();
		    foreach ($value->countryISO as $i => $country) {
		    			$country_code[]=$country;

		    			//$offer['offer_geo']['target'][] = array('country'=>$country,'type'=>1);
		    }
		    $platform=self::platform($value);
		    $countries = Util::getCountryName(implode(';',$country_code));

    		$categories = array('uncategory');

    		$tracking_link = $value->clickUrl;

    		if(isset($get_offer->data->rowset)){
    			if(count($get_offer->data->rowset) >0){
    				

	    			$offer =array( 
			    			'offer'=>[
			    				'name'=>substr($value->name,0,40),
								'advertiser_id'=>$id,
								'status'=>'active',
								'revenue'=>number_format($payout,2, '.', ''),
								'payout'=>number_format($payout * 0.90, 2, '.', ''),
								'preview_url'=>$value->preview_url,
								'destination_url'=>$tracking_link,
								'description'=>$value->description,
			    			],
			    			'offer_category'=>array('name'=>substr(implode(',',$categories),0,40)),
			    			'offer_geo'=>array('target'=>array()),
			    			'offer_platform'=> $platform
		    			
		    			);
	    			
		    		foreach ($countries as $c => $country) {
		    			$offer['offer_geo']['target'][] = array('country'=>$country,'type'=>1);
		    		}	
		    	
		    	$offer_look= Util::updateOffer($offer,$get_offer->data->rowset[0]->id);

		    	if($thumbnail_link !=''){
		    		Util::thumbnail($thumbnail_link,$get_offer->data->rowset[0]->id);
		    	}
		    	try{
	 
						$offers_log= new OffersLog();
						$offers_log->message = $value->name. " Offer Updated";
						$offers_log->offer_id=$id;
						$offers_log->save();
						$logs[]= array(
							 		'log'=>$offers_log,
							 		
						);
   	
    				}catch(\exception $ex){

    				}
    			
    		}else{
    			$offer =array( 
    			'offer'=>[
    				'name'=>substr($value->name,0,40),
					'advertiser_id'=>$id,
					'offer_approval'=>1,
					'pricing_type'=>'CPI',
					'status'=>'active',
					'revenue'=>number_format($payout,2, '.', ''),
					'payout'=>number_format($payout * 0.90, 2, '.', ''),
					'preview_url'=>$value->preview_url,
					'destination_url'=>$tracking_link,
					'description'=>$value->description,
					
						
	    			],
	    			'offer_category'=>array('name'=>substr(implode(',',$categories),0,40)),
	    			'offer_geo'=>array('target'=>array()),
	    			'offer_cap'=>array(
	    				'cap_budget'=>'10000',
						'cap_click'=>9999999,
						'cap_type'=>2,
						'cap_conversion'=>10000,
						'cap_timezone',
	    			),
			    	'offer_platform'=> $platform
	    			
    			);
	    			foreach ($countries as $c => $country) {
			    			$offer['offer_geo']['target'][] = array('country'=>$country,'type'=>1);
			    	}	
	    			$offer_look= Util::createOffer($offer);
	    			if(isset($offer_look->data->error)){
	    				$offers_log= new OffersLog();
							
							$offers_log->message = $value->name. " Offer error : ".$offer_look->data->error->error;
								$offers_log->offer_id=$id;
							$offers_log->save();
							$logs[]= array(
									 		'log'=>$offers_log,
									 		
							);
	    				
	    			}else{
	    				try{
	    				
	    					if($thumbnail_link !=''){
					    		Util::thumbnail($thumbnail_link,$offer_look->data->offer->id);
					    	}
		    				
							$offers_log= new OffersLog();
							$offers_log->offer_id=$id;
							$offers_log->message = $value->name. " Offer Created";
							$offers_log->save();
							$logs[]= array(
									 		'log'=>$offers_log,
									 		
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

	public static getOffer($apikey){
		$args = array(
        'apiKey' => $apikey
   		 );
		

		try{
			$curl = new cURL;

			$url = $curl->buildUrl('http://login.cpiapi.com/getOffers/v1', $args);
			$data=$curl->newRequest('get',$url);
			$response = json_decode($data->send());
		return $response;

		}catch(\exception $ex){
		 	return array();
		 
		}
	}
	public static function platform($value){
	
		$system = array();
		if($value->ipad==1){
			$system[]='ios';
		}
		if($value->iphone==1){
			$system[]='ios';
		}
		if($value->android==1){
			$system[]='android';
		}
		if($value->ipod==1){
			$system[]='ios';
		}
		return $platform = array('platform'=>'Mobile','system'=>implode(',',$system));
	}

	public static function deleteSync($id,$api){
		set_time_limit(0);
    	//dd('adfg');
    	$offers =Util::getOffer(array('limit'=>10000,'filters'=>array('advertiser_id'=>array('EQUAL_TO'=>$id))));
   
    	$offers_this = self::getOffer($api);

    	foreach ($offers->data->rowset as $key => $offer) {
    		 $flag = false;

    		 foreach ($offers_this->offers as $key => $value) {
    				
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
				$offers_log->offer_id = $id;
				$offers_log->message = $offer->name. " Offer DLETED";
				$offers_log->save();	
    		}
    		
    	}

    	return Response::json([
            'messages' => 'Successfully Sync AppThis',
           
           
        ], 200, array(), JSON_PRETTY_PRINT);
	}
}
