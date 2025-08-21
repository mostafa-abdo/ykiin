<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPhoneToEventPaymentLogsTable extends Migration
{

    public function up()
    {
        Schema::table('event_payment_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('event_payment_logs', 'phone')) {
                $table->string('phone')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('event_payment_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('event_payment_logs', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
}
