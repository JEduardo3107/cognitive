<?php

namespace App\Models\Result;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game6Result extends Model{
    use HasFactory;

    protected $table = 'game6_results';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'session_id',
        'time',
    ];
}