<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ActivityArea extends Model{
    use HasFactory, HasUuids;

    protected $table = 'activity_areas';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
    ];

    public function availableActivities(){
        return $this->hasMany(AvailableActivity::class, 'area_id');
    }
}