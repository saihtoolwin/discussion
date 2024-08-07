<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('user', 'comment', 'like', 'questionSave', 'tag')->get();
        foreach ($questions as $question) {
            $likeDetails = $this->likeDetails($question->id);
            $question->is_like = $likeDetails['is_like'];
            $question->like_count = $likeDetails['like_count'];
        }
        // return response()->json($questions);

        return Inertia::render('Home', [
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function likeDetails($question_id)
    {
        $q_like = QuestionLike::where('question_id', $question_id)
            ->where('user_id', Auth::user()->id)->first();

        if ($q_like) {
            $is_like = "true";
        } else {
            $is_like = "false";
        }

        $like_count = QuestionLike::where('question_id', $question_id)->count();

        $data['like_count'] = $like_count;
        $data['is_like'] = $is_like;

        return $data;
    }
}
