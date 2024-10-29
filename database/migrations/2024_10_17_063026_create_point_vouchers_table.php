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
        Schema::create('point_vouchers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('site_id')->constrained('sites')->cascadeOnDelete();
            $table->string('name')->unique();
            $table->string('latitude')->unique();
            $table->string('longitude')->unique();
            $table->timestamps();
        });
    }

    /**wc
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_vouchers');
    }
};
