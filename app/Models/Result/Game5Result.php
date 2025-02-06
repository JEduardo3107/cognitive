<?php

namespace App\Models\Result;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game5Result extends Model{
    use HasFactory;

    protected $table = 'game5_results';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'session_id',
        'time',

        'value_1',
        'user_selection_1',
        'value_2',
        'user_selection_2',
        'value_3',
        'user_selection_3',
        'value_4',
        'user_selection_4',
        'value_5',
        'user_selection_5',

        'percentage',
    ];
}