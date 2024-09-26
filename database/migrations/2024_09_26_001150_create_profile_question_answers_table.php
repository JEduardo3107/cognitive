<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('profile_question_answers', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Columna UUID como clave primaria
            $table->uuid('profile_question_id'); // Columna UUID que se relaciona con la pregunta
            $table->string('answer_text', 600); // Campo de texto con longitud de 600 caracteres para la respuesta
            $table->boolean('is_enabled')->default(true); // Campo booleano con valor predeterminado true
            $table->timestamps(); // Agrega columnas created_at y updated_at automáticamente
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('profile_question_answers');
    }
};
