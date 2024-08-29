<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveQuestion extends Model
{
    use HasFactory;

    protected $fillable=['user_id','question_id'];


    public function questions()
    {
        return $this->belongsTo(Question::class,'question_id');
    }
}
