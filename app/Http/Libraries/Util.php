<?php

namespace App\Http\Libraries;

use Illuminate\Http\Request;

use App\Http\Requests;
use anlutro\cURL\cURL;

class Util 
{
	public static function Mobra(){
		$client = new \GuzzleHttp\Client(['base_uri' => 'https://api.mobra.in','cookies'=>true]);
		$data  = $client->request('POST', '/v1/auth/login', ['form_params'=>['user'=>'dave@adstuna.com','password'=>'Mobrain123'],'cookies' => $cookieJar]);
	}
	
	/**
	* Get AppThis feed
	**/
	public static function appThis(){
		 $curl = new cURL;
		
		$data=$curl->newRequest('get','http://feed.appthis.com/feed/v1?api_key='.env('ADVERTISER_THISAP_KEY').'&format=json');
		$response = json_decode($data->send());

		return $response;
	}

	public static function createOffer($offer){
		 try{
		 	 $curl = new cURL;

		
			$data=$curl->newJsonRequest('post',env('API_OFFER_URL').'/v1/offers',$offer)
			   ->setUser('adstuna')->setPass(env('API_OFFERS_LOOK_KEY'));
			$response = json_decode($data->send());

			return $response;
		 }catch(\exception $ex){
		 	return array();
		 }
		
	}

	public static function updateOffer($offer,$id){
		try{
			 $curl = new cURL;

		
		$data=$curl->newJsonRequest('put',env('API_OFFER_URL').'/v1/offers/'.$id,$offer)
		   ->setUser('adstuna')->setPass(env('API_OFFERS_LOOK_KEY'));
		$response = json_decode($data->send());

		return $response;
		 }catch(\exception $ex){
		 	return array();
		 }
		
	}

	public static function getOffer($params){
		try{
			 $curl = new cURL;

		$url = $curl->buildUrl(env('API_OFFER_URL').'/v1/offers/', $params);
		$data=$curl->newRequest('get',$url)
		   ->setUser('adstuna')->setPass(env('API_OFFERS_LOOK_KEY'));
		$response = json_decode($data->send());

		return $response;
		 }catch(\exception $ex){
		 	return array();
		 }
		
	}
	public static function thumbnail($str,$id){
		
		try{
			$temp= 'temp/'.time().".jpg";

		file_put_contents($temp, file_get_contents($str));
		$file = curl_file_create($temp);
		$offer = ['file'=>$file];
			 $curl = new cURL;

		
		$data=$curl->newRawRequest ('post',env('API_OFFER_URL').'/v1/offers/'.$id.'/thumbnails',$offer)
		   ->setUser('adstuna')->setPass(env('API_OFFERS_LOOK_KEY'));
		$response = json_decode($data->send());
		unlink($temp);
			return $response;
		 }catch(\exception $ex){
		 	return $ex;
		 }
	}
	public static function getCountryName($code){
		$country= array();
		try{
			$curl = new cURL;
		
			$data=$curl->newRequest('get','https://restcountries.eu/rest/v1/alpha?codes='.$code);
			$response = json_decode($data->send());

			foreach ($response as $key => $value) {
				$country[]=$value->name;
			}
			return $country;
		}catch(\exception $ex){
			return $country;
		}
		
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

}