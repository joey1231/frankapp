<?php

namespace App\Models\Components;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
	protected $table='offers';
    protected $fillable=[
    	'name',
		'advertiser_id',
		'start_date',
		'end_date',
		'status',
		'offer_approval'=>1,
		'pricing_type'=>'CPI',
		'revenue',
		'payout',
		'preview_url'=>'http://www.adstuna.com',
		'destination_url',
		'description',
		'push_allowed',
		'incent_allowed',
		'adult_allowed',
		'redirect_offer_id',
		'global_redirect_enabled',
		'currency',
		'conversion_protocol',
		'platform',
		'system',
		'version',
		'name',
		'cap_budget'=>'10,000',
		'cap_click'=>9999999,
		'cap_type'=>2,
		'cap_conversion'=>10000,
		'cap_timezone',
    ];
   
}
