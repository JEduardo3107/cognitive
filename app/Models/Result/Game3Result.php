<?php

namespace App\Models\Result;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game3Result extends Model{
    use HasFactory;

    protected $table = 'game3_results';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'session_id',
        'time',

        'number_required',
        'user_input',
        'is_valid',
        'sequence_data',
    ];

    protected $casts = [
        'sequence_data' => 'array',
    ];
}