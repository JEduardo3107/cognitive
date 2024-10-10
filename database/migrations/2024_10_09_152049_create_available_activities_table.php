<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('available_activities', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->uuid('area_id');
            $table->string('name', 50);
            $table->string('description', 250)->nullable();
            $table->string('image_name', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('available_activities');
    }
};