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
            $table->string('payment_gateway')->nullable()->change();
            $table->text('payment_account_details')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_withdraws', function (Blueprint $table) {
            $table->string('payment_gateway')->nullable(false)->change();
            $table->text('payment_account_details')->nullable(false)->change();
        });
    }
};
