<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'is_fixed',
    ];

    public function scopeFilterBy(Builder $query,?string $tag ): Builder
    {
        // dd($tag);
        return $query->when(isset($tag),function($query) use ($tag){
            $query->whereHas('tag',function($query) use ($tag){
                $query->where('slug',$tag);
            });
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function comment()
    {
        return $this->hasMany(QuestionComment::class,'question_id');
    }

    public function like()
    {
        return $this->hasMany(QuestionLike::class,'question_id');
    }

    public function questionSave()
    {
        return $this->hasMany(SaveQuestion::class,'question_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class,'question_tags');
    }
}
