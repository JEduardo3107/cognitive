<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::table('profile_answers', function (Blueprint $table) {
            $table->uuid('question_id')->after('user_question_answer_selected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::table('profile_answers', function(Blueprint $table){
            $table->dropColumn('question_id'); // Eliminar la columna 'question_id'
        });
    }
};