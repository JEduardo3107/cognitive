<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('game2_results', function (Blueprint $table){
            $table->unsignedBigInteger('user_id');
            $table->uuid('session_id');
            $table->integer('time');
            $table->integer('number_1');
            $table->integer('number_1_response');
            $table->integer('number_2');
            $table->integer('number_2_response');
            $table->integer('number_3');
            $table->integer('number_3_response');
            $table->integer('number_4');
            $table->integer('number_4_response');
            $table->timestamps();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('game2_results');
    }
};