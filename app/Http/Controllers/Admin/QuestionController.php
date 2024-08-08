<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\Question as QuestionTraits;
class QuestionController extends Controller
{
    use QuestionTraits;
    public function index($slug)
    {
        $questions = Question::where('slug',$slug)->with('user', 'comment', 'like', 'questionSave', 'tag')->get();
        foreach ($questions as $question) {
            $likeDetails = $this->getlikeDetails($question->id);
            $question->is_like = $likeDetails['is_like'];
            $question->like_count = $likeDetails['like_count'];
        }
        // return response()->json($questions);

        return Inertia::render('QuestionDetail', [
            'questions' => $questions,
        ]);
    }
}
