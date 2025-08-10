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
        Schema::create('payment', function (Blueprint $table) {
            $table->string('id',50)->primary();
            $table->string('payment_method', 50);
            $table->string('transaction_name', 100);
            $table->bigInteger('amount')->default(0);
            $table->timestamp('payment_date')->useCurrent();
            $table->integer('qty')->default(1);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**php 
     * Reverse the migrations.
     */
    public function down(): void
    {
       //
    }
};
