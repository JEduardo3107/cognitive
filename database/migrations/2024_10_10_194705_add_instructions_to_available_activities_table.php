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
            $table->string('instructions', 500)->after('description')->default('Instrucciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::table('available_activities', function(Blueprint $table){
            $table->dropColumn('instructions');
        });
    }
};