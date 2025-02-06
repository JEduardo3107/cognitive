<?php

namespace App\Models\Result;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game4Result extends Model{
    use HasFactory;

    protected $table = 'game4_results';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'session_id',
        'time',

        'number_winner',
        'number_top',
        'number_center',
        'number_bottom',

        'percentage',
    ];
}