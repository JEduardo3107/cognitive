<?php

namespace App\Models\Games;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Game1 extends Model{
    use HasFactory, HasUuids;

    protected $table = 'game1';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'activity_id',
        'name',
        'option1',
        'option2',
    ];

    public function options(){
        return $this->hasMany(Game1Setting::class, 'game_id', 'id');
    }
}