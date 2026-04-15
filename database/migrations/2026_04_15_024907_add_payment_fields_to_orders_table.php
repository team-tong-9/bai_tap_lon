<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_date')->nullable()->after('payment_status');
            $table->string('payment_method_detail')->nullable()->after('payment_method');
            $table->string('invoice_number')->nullable()->after('order_number');
            $table->text('admin_notes')->nullable()->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_date', 'payment_method_detail', 'invoice_number', 'admin_notes']);
        });
    }
};
