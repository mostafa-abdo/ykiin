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
        Schema::table('cause_logs', function (Blueprint $table) {
            $table->double('transaction_fee')->nullable()->after('admin_charge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cause_logs', function (Blueprint $table) {
            $table->dropColumn('transaction_fee');
        });
    }
};
