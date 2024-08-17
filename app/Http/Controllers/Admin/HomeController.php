<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Traits\Question as QuestionTraits;
class HomeController extends Controller
{
    use QuestionTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('user', 'comment', 'like', 'questionSave', 'tag')->inRandomOrder()->get();
        foreach ($questions as $question) {
            $likeDetails = $this->getlikeDetails($question->id);
            $question->is_like = $likeDetails['is_like'];
            $question->like_count = $likeDetails['like_count'];
            // $question->image = url_storage;
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

    
}
