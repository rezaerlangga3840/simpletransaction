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
        Schema::create('transaction_details_temp', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaction');
            $table->string('item');
            $table->double('quantity', 128, 8)->default(0.00000000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details_temp');
    }
};
