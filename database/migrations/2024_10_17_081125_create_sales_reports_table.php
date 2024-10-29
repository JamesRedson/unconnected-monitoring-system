<?php

use App\Enum\VoucherPrice;
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
        Schema::create('sales_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('point_voucher_id')->constrained()->cascadeOnDelete();
            $table->enum('voucher_price', array_column(VoucherPrice::cases(), 'value'))->index();
            $table->string('total_voucher_sales');
            $table->string('total_amount');
            $table->date('reported_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_reports');
    }
};
