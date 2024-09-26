<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProfileQuestionAnswer extends Model{
    use HasFactory, HasUuids;

    protected $table = 'profile_question_answers';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'profile_question_id',
        'answer_text',
        'is_enabled'
    ];
}