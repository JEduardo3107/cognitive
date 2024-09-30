<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AvailableArea extends Model{
    use HasFactory, HasUuids;

    protected $table = 'available_areas';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'area_name',
        'is_enabled',
    ];

    public function questions(){
        return $this->hasMany(ProfileQuestion::class, 'area_id', 'id')
                    ->where('is_enabled', true);
    }
}