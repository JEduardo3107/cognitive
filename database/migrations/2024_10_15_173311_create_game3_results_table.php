<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('game3_results', function(Blueprint $table){
            $table->unsignedBigInteger('user_id');
            $table->uuid('session_id');
            $table->integer('time');
           
            $table->integer('number_required'); // Número requerido por la secuencia
            $table->integer('user_input'); // Número ingresado por el usuario
            $table->boolean('is_valid'); // True si la secuencia fue válida, False si no
            $table->json('sequence_data')->nullable();

            $table->timestamps();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('game3_results');
    }
};