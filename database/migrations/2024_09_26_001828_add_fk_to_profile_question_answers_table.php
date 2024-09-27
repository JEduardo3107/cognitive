<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::table('profile_question_answers', function(Blueprint $table){
            $table->foreign('profile_question_id')->references('id')->on('profile_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::table('profile_question_answers', function(Blueprint $table){
            $table->dropForeign(['profile_question_id']);
        });
    }
};