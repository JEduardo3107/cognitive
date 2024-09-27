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
            $table->integer('order_position')->after('answer_text')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::table('profile_question_answers', function(Blueprint $table){
            $table->dropColumn('order_position');
        });
    }
};