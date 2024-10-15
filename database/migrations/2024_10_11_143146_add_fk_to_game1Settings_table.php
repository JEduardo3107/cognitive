<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::table('game1Settings', function(Blueprint $table){
            // Definición de las llaves foráneas
            $table->foreign('game_id')->references('id')->on('game1')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::table('game1Settings', function(Blueprint $table){
            $table->dropForeign(['game_id']);
        });
    }
};