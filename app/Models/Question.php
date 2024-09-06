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

    public function scopeFilterBy(Builder $query, ?string $tag, ?string $type): Builder
    {
        if ($type === 'answer') {
            $type = 'true';
        } elseif ($type === 'unanswer') {
            $type = 'false';
        }
       
        return $query->when(isset($tag), function ($query) use ($tag) {
            $query->whereHas('tag', function ($query) use ($tag) {
                $query->where('slug', $tag);
            });
        })->when($type, function ($query) use ($type) {
            $query->where('is_fixed', $type)
                ->when($type === 'true', function ($query) {
                    $query->whereHas('comment');
                });
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->hasMany(QuestionComment::class, 'question_id');
    }

    public function like()
    {
        return $this->hasMany(QuestionLike::class, 'question_id');
    }

    public function questionSave()
    {
        return $this->hasMany(SaveQuestion::class, 'question_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'question_tags');
    }
}
