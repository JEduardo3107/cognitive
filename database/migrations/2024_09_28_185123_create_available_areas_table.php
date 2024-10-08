<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('available_areas', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('area_name');
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('available_areas');
    }
};
