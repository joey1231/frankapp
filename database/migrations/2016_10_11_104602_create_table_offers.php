<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');               
            $table->string('advertiser_id')->default(3);
            $table->string('offer_approval')->default(1);
            $table->string('pricing_type')->default('CPI');
            $table->string('revenue');
            $table->string('payout');
            $table->string('preview_url')->default('http://www.adstuna.com');
            $table->string('destination_url');
            $table->text('description');
            $table->string('cap_budget')->default('10000');
            $table->string('cap_click')->default('9999999');
            $table->string('cap_type')->default('2');
            $table->string('cap_conversion')->default('10000');
            $table->string('offers_look_id');
            $table->string('offer_id');
            $table->string('offer_category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('offers');
    }
}
