<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking', function (Blueprint $table) {
            // $table->increments('id');
            $table->integer('creative_id');
            $table->integer('store_id');
            $table->integer('campaign_id');
            $table->integer('next_brand')->default(1);
            $table->integer('impressions')->default(0);
            $table->unique(['campaign_id', 'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracking');
    }
}
