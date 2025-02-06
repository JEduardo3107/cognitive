<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('game4_results', function(Blueprint $table){
            $table->unsignedBigInteger('user_id');
            $table->uuid('session_id');
            $table->integer('time');

            $table->integer('number_winner');
            $table->integer('number_top');
            $table->integer('number_center');
            $table->integer('number_bottom');

            $table->integer('percentage');

            $table->timestamps();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('game4_results');
    }
};