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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->string('plate_number', 36)->primary();
            $table->string('brand', 50);
            $table->string('model', 50);
            $table->string('pict1', 255);
            $table->string('pict2', 255);
            $table->string('pict3', 255);
            $table->bigInteger('price')->default(0);
            $table->string('availability', 20)->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
