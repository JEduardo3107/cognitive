<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AvailableActivity extends Model{
    use HasFactory, HasUuids;

    protected $table = 'available_activities';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'game_id',
        'area_id',
        'name',
        'description',
        'image_name',
    ];

    public function activityArea(){
        return $this->belongsTo(ActivityArea::class, 'area_id');
    }
}