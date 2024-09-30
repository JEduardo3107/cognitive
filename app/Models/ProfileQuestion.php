<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProfileQuestion extends Model{
    use HasFactory, HasUuids;

    protected $table = 'profile_questions';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'area_id',
        'question_title',
        'is_enabled',
        'order_position'
    ];

    public function answers(){
        return $this->hasMany(ProfileQuestionAnswer::class, 'profile_question_id', 'id')
                    ->where('is_enabled', true)
                    ->orderBy('order_position', 'asc');
    }
}