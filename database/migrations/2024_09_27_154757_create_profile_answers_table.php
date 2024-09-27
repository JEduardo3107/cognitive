<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('profile_answers', function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->uuid('user_question_answer_selected');
            $table->timestamps();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('profile_answers');
    }
};