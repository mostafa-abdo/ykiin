<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnAppleIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	
        Schema::table('users', function (Blueprint $table) {
            if(!Schema::hasColumn('users','apple_id')){
            $table->string('apple_id')->nullable();
            $table->bigInteger('deactivate')->default(0);
            }
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasColumn('users','apple_id')){
             $table->dropColumn('apple_id');
             $table->dropColumn('deactivate');
            }
        });
    }
}