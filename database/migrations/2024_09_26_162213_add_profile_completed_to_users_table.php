<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::table('users', function (Blueprint $table){
            $table->boolean('profile_completed')->after('email')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn('profile_completed');
        });
    }
};