<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('profile_questions', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->string('area', 100);
            $table->string('question_title', 600);
            $table->boolean('is_enabled')->default(true);
            $table->integer('order_position');
            $table->timestamps();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('profile_questions');
    }
};