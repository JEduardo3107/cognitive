<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LoginStreak extends Model{
    use HasFactory, HasUuids;

    protected $table = 'login_streaks';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'day_login',
        'hour_login',
        'user_id'
    ];
}
