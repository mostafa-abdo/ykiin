<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('donation_withdraws', function (Blueprint $table) {
            $table->bigInteger('gateway_id')->nullable()->after('payment_gateway');
            $table->longText('gateway_fields')->nullable()->after('gateway_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_withdraws', function (Blueprint $table) {
            $table->dropColumn('gateway_id');
            $table->dropColumn('gateway_fields');
        });
    }
};
