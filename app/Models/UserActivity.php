<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserActivity extends Model{
    use HasFactory, HasUuids;

    protected $table = 'user_activities';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'session_id';
    public $timestamps = true;

    protected $fillable = [
        'session_id',
        'user_id',
        'activity_id_1',
        'activity_1_completed',
        'activity_id_2',
        'activity_2_completed',
        'activity_id_3',
        'activity_3_completed',
        'activity_id_4',
        'activity_4_completed',
        'activity_id_5',
        'activity_5_completed',
        'activity_id_6',
        'activity_6_completed',
    ];
}