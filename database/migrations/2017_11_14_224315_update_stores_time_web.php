<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStoresTimeWeb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('stores', function($table) {
            $table->string('web_url')->nullable();
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
         Schema::table('stores', function($table) {
            $table->dropColumn(['web_url', 'created_at', 'updated_at']);
        });
    }
}
