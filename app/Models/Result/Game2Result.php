<?php

namespace App\Models\Result;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game2Result extends Model{
    use HasFactory;

    protected $table = 'game2_results';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'session_id',
        'time',
        'number_1',
        'number_1_response',
        'number_2',
        'number_2_response',
        'number_3',
        'number_3_response',
        'number_4',
        'number_4_response', 
    ];
}