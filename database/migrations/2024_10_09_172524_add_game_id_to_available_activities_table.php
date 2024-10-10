<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::table('available_activities', function(Blueprint $table){
            $table->integer('game_id')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::table('available_activities', function(Blueprint $table){
            $table->dropColumn('game_id');
        });
    }
};