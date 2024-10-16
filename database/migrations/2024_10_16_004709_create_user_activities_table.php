<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('user_activities', function(Blueprint $table){
            $table->uuid('session_id');
            $table->unsignedBigInteger('user_id');
            $table->uuid('activity_id_1');
            $table->boolean('activity_1_completed')->default(false);
            $table->uuid('activity_id_2');
            $table->boolean('activity_2_completed')->default(false);
            $table->uuid('activity_id_3');
            $table->boolean('activity_3_completed')->default(false);
            $table->timestamps();
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('user_activities');
    }
};