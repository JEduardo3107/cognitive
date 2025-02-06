<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('game5_results', function(Blueprint $table){
            $table->unsignedBigInteger('user_id');
            $table->uuid('session_id');
            $table->integer('time');

            $table->uuid('value_1');
            $table->uuid('user_selection_1');

            $table->uuid('value_2');
            $table->uuid('user_selection_2');

            $table->uuid('value_3');
            $table->uuid('user_selection_3');

            $table->uuid('value_4');
            $table->uuid('user_selection_4');

            $table->uuid('value_5');
            $table->uuid('user_selection_5');

            $table->integer('percentage');
            $table->timestamps();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('game5_results');
    }
};