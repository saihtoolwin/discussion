<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    use HasFactory;

    protected $fillable=['image','comment','question_id','user_id'];

    protected $appends=['date'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class,'question_id');
    }

    public function getDateAttribute()
    {
        return (new Carbon($this->created_at))->diffForHumans();
    }
}
