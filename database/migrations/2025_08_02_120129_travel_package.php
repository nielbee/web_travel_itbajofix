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
       Schema::create('travel_packages', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('title')->unique();
           $table->string('description');
           $table->string('photo1')->nullable();
           $table->string('photo2')->nullable();
           $table->string('photo3')->nullable();
           $table->string('default_message');
           $table->integer('price');
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_packages');
    }
};
