<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('login_streaks', function (Blueprint $table){
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->date('day_login');
            $table->time('hour_login');
            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('login_streaks');
    }
};