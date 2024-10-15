<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('game1Settings', function(Blueprint $table){
            $table->uuid('id')->primary(); // Clave primaria UUID
            $table->uuid('game_id'); // UUID para referenciar a game1
            $table->string('display_word', 50);
            $table->string('valid_option', 30); // La opción válida (una de las dos opciones)
            $table->timestamps();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('game1Settings');
    }
};