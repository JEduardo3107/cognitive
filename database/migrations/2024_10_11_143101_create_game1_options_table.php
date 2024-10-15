<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('game1', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->uuid('activity_id'); // UUID for activity
            $table->string('name', 20);
            $table->string('option1', 30);
            $table->string('option2', 30);
            $table->timestamps();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('game1');
    }
};