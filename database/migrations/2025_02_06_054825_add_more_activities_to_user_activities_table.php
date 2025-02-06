<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::table('user_activities', function (Blueprint $table) {
            $table->uuid('activity_id_4')->default('fdc96e2a-c4e2-4785-8897-0f6ed2f452b6')->after('activity_3_completed');
            $table->boolean('activity_4_completed')->default(false)->after('activity_id_4');
            $table->uuid('activity_id_5')->default('d91794a5-2c04-41a8-9c5b-8691317ff7f2')->after('activity_4_completed');
            $table->boolean('activity_5_completed')->default(false)->after('activity_id_5');
            $table->uuid('activity_id_6')->default('bcf9bdb9-e447-4d3a-92de-810298e3a761')->after('activity_5_completed');
            $table->boolean('activity_6_completed')->default(false)->after('activity_id_6');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::table('user_activities', function (Blueprint $table) {
            $table->dropColumn([
                'activity_id_4', 'activity_4_completed',
                'activity_id_5', 'activity_5_completed',
                'activity_id_6', 'activity_6_completed',
            ]);
        });
    }
};