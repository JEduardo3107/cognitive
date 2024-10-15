<?php

namespace App\Models\Result;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Games\Game1Setting;

class Game1Result extends Model{
    use HasFactory;

    protected $table = 'game1_results';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'session_id',
        'word_id',
        'user_selection',
        'status',
        'time'
    ];

    public function word(){
        return $this->belongsTo(Game1Setting::class, 'word_id', 'id');
    }
}