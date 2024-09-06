<?php

namespace App\Traits;

use App\Models\QuestionLike;
use App\Models\SaveQuestion;
use Illuminate\Support\Facades\Auth;

trait Question
{
    public function getlikeDetails($question_id)
    {
        $q_like = QuestionLike::where('question_id', $question_id)
            ->where('user_id', Auth::user()->id)->first();

        if ($q_like) {
            $is_like = "true";
        } else {
            $is_like = "false";
        }

        $like_count = QuestionLike::where('question_id', $question_id)->count();

        $quesiton_save=SaveQuestion::where('question_id',$question_id)
        ->where('user_id', Auth::user()->id)->first();

        if ($quesiton_save) {
            $quesiton_save = "true";
        } else {
            $quesiton_save = "false";
        }

        $data['like_count'] = $like_count;
        $data['is_like'] = $is_like;
        $data['save_quesiton']=$quesiton_save;

        return $data;
    }

}