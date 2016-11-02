<?php

namespace App\Http\Libraries;

use Illuminate\Http\Request;

use App\Http\Requests;
use anlutro\cURL\cURL;
use App\Http\Libraries\Util;
use Response;
use App\Models\Components\Offer;
use App\Models\Components\OffersLog;
class Hasoffer 
{

	public static function syncoffer($id,$network,$api){
		 set_time_limit(0);
    	$logs = array();
    	
    	$offers = self::getOffersHasOffers($network,$api);


    	foreach ($offers->response->data as $key => $value) {
    		$value=$value->Offer;

    		$get_offer = Util::getOffer(array('filters'=>array('name'=>array('EQUAL_TO'=>substr($value->name,0,40)),'advertiser_id'=>array('EQUAL_TO'=>$id))));
    		$payout = self::getPayout($network,$api,$value->id);
    		//sleep(1);
    		
    		$thumbnail_link = self::GetThumbnail($network,$api,$value->id);
    		$country_code=self::GetCountries($network,$api,$value->id);

    		$countries = Util::getCountryName(implode(';',$country_code));
    		$categories = self::GetCategories($network,$api,$value->id);
    		$platform=self::platform($value);

    		$tracking_link =  self::generateTrackingLink($network,$api,$value->id,array('clickid'=>'{clickid}','source'=>'{aff_id}','source2'=>'{source_id}'));

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
			    			'offer_category'=>array('name'=>$categories),
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
	    			'offer_category'=>array('name'=>$categories),
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
	    			dd($offer);
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

	public static function deleteSync($id,$network,$api){
		set_time_limit(0);
    	//dd('adfg');
    	$offers =Util::getOffer(array('limit'=>10000,'filters'=>array('advertiser_id'=>array('EQUAL_TO'=>$id))));
   
    	$offers_this = self::getOffersHasOffers($network,$api);

    	if(isset($get_offer->data->rowset)){
	    	foreach ($offers->data->rowset as $key => $offer) {
	    		 $flag = false;

	    		 foreach ($offers_this->response->data as $key => $value) {
	    				$value=$value->Offer;
	    		
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
    	}

    	return Response::json([
            'messages' => 'Successfully Sync AppThis',
           
           
        ], 200, array(), JSON_PRETTY_PRINT);
	}
	public static function getOffersHasOffers($NetworkId,$api){
		$args = array(
        'NetworkId' => $NetworkId,
        'Target' => 'Affiliate_Offer',
        'Method' => 'findAll',
        'api_key' => $api
   		 );
		

		try{
			$curl = new cURL;

			$url = $curl->buildUrl('https://api.hasoffers.com/Apiv3/json', $args);
			$data=$curl->newRequest('get',$url);
			$response = json_decode($data->send());
		return $response;

		}catch(\exception $ex){
		 	return array();
		 
		}
	}

	public static function generateTrackingLink($NetworkId,$api,$offerid,$params){

		$link ='';
		$args = array(
        'NetworkId' => $NetworkId,
        'Target' => 'Affiliate_Offer',
        'Method' => 'generateTrackingLink',
        'api_key' => $api,
        'offer_id' =>$offerid,
        'params'	=>$params
   		 );
		

		try{
			$curl = new cURL;

			$url = $curl->buildUrl('https://api.hasoffers.com/Apiv3/json', $args);
			$data=$curl->newRequest('get',$url);
			$response = json_decode($data->send());
			if($response->response->httpStatus==200){
				$link = $response->response->data->click_url;
			}

		return $link;

		}catch(\exception $ex){
		 	return $link;
		 
		}
	}

	public static function getPayout($NetworkId,$api,$offerid){
		$link =0;
		$args = array(
        'NetworkId' => $NetworkId,
        'Target' => 'Affiliate_Offer',
        'Method' => 'getPayoutDetails',
        'api_key' => $api,
        'offer_id' =>$offerid,
        
   		 );
		

		try{
			$curl = new cURL;

			$url = $curl->buildUrl('https://api.hasoffers.com/Apiv3/json', $args);
			$data=$curl->newRequest('get',$url);
			$response = json_decode($data->send());
			if($response->response->httpStatus==200){
				$link = $response->response->data->offer_payout->payout;
			}

		return $link;

		}catch(\exception $ex){
		 	return $link;
		 
		}
	}

	public static function GetThumbnail($NetworkId,$api,$offerid){
		$link ='';
		$args = array(
        'NetworkId' => $NetworkId,
        'Target' => 'Affiliate_Offer',
        'Method' => 'getThumbnail',
        'api_key' => $api,
        'ids' =>array($offerid),
        
   		 );
		

		try{
			$curl = new cURL;

			$url = $curl->buildUrl('https://api.hasoffers.com/Apiv3/json', $args);
			$data=$curl->newRequest('get',$url);
			$response = json_decode($data->send());
			if($response->response->httpStatus==200){
				foreach ($response->response->data as $key => $value) {
					return $value->Thumbnail->url;
				}
			}

		return $link;

		}catch(\exception $ex){
		 	return $link;
		 
		}
	}

	public static function GetCategories($NetworkId,$api,$offerid){
		$link =array();
		$args = array(
        'NetworkId' => $NetworkId,
        'Target' => 'Affiliate_Offer',
        'Method' => 'getCategories',
        'api_key' => $api,
        'ids' =>array($offerid),
        
   		 );
		

		try{
			$curl = new cURL;

			$url = $curl->buildUrl('https://api.hasoffers.com/Apiv3/json', $args);
			$data=$curl->newRequest('get',$url);
			$response = json_decode($data->send());
			if($response->response->httpStatus==200){
				foreach ($response->response->data as $key => $value) {
					foreach ($value->categories as $c => $cat) {
						$link[] = $cat->name;
					}
				}
			}

		return $link;

		}catch(\exception $ex){
		 	return $link;
		 
		}
	}

	public static function GetCountries($NetworkId,$api,$offerid){
		$link =array();
		$args = array(
        'NetworkId' => $NetworkId,
        'Target' => 'Affiliate_Offer',
        'Method' => 'getTargetCountries',
        'api_key' => $api,
        'ids' =>array($offerid),
        
   		 );
		

		try{
			$curl = new cURL;

			$url = $curl->buildUrl('https://api.hasoffers.com/Apiv3/json', $args);
			$data=$curl->newRequest('get',$url);
			$response = json_decode($data->send());
			if($response->response->httpStatus==200){
				foreach ($response->response->data as $key => $value) {
					foreach ($value->countries as $c => $cat) {
						$link[] = $key;
					}
				}
			}

		return $link;

		}catch(\exception $ex){
		 	return $link;
		 
		}
	}

	public static function platform($value){
	
		return $platform = array('platform'=>'Mobile');
	}

}