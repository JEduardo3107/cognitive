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
        'is_enabled',
        'order_position'
    ];

    // Relación con ProfileAnswer
    public function answersSelected(){
        return $this->hasMany(ProfileAnswer::class, 'user_question_answer_selected', 'id');
    }

    // Método para contar las veces que una respuesta ha sido seleccionada
    public function getCount(){
        return $this->answersSelected()->count();
    }

    public function question(){
        return $this->belongsTo(ProfileQuestion::class, 'profile_question_id');
    }
}
