<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\SaveQuestion;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\Question as QuestionTraits;
use Illuminate\Support\Facades\Auth;

use function Termwind\render;

class QuestionController extends Controller
{
    use QuestionTraits;
    public function index($slug)
    {
        $questions = Question::where('slug', $slug)->with('user', 'comment.user', 'like', 'questionSave', 'tag')->get();
        foreach ($questions as $question) {
            $likeDetails = $this->getlikeDetails($question->id);
            $question->is_like = $likeDetails['is_like'];
            $question->like_count = $likeDetails['like_count'];
            $question->save_question=$likeDetails['save_quesiton'];
        }
        return Inertia::render('QuestionDetail', [
            'questions' => $questions,
        ]);
    }

    public function create()
    {
        $tags = Tag::all();
        return Inertia::render('CreateQuestion', [
            'tags' => $tags,
        ]);
    }

    public function store(Request $request, Question $question)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'question' => 'required|string',
            'tags' => 'array|required',
            'tags.*' => 'integer|exists:tags,id',
        ]);

        $question = Question::create([
            'title' => $validatedData['title'],
            'slug' => \Str::slug($validatedData['title']),
            'description' => $validatedData['question'],
            'user_id' => auth()->id(),
        ]);

        if ($validatedData['tags']) {
            $tags = Tag::whereIn('id', $validatedData['tags'])->pluck('id');
            $question->tag()->attach($tags);
        }

        return to_route('home.index');
    }

    public function update(Question $question, Request $request)
    {
        $question = $question->find($request->id);
        $question->update([
            'is_fixed' => 'true',
        ]);
        return back();
    }

    public function userQuestion()
    {
        $questions = Question::where('user_id', Auth::id())->with('user', 'comment.user', 'like', 'questionSave', 'tag')->paginate(5);
        foreach ($questions as $question) {
            $likeDetails = $this->getlikeDetails($question->id);
            $question->is_like = $likeDetails['is_like'];
            $question->like_count = $likeDetails['like_count'];
            $question->save_question=$likeDetails['save_quesiton'];
        }
        return Inertia::render('UserQuestion', [
            'questions' => $questions,
        ]);
    }

    public function destory(Question $question)
    {
        $question->delete();
        return to_route('home.index');
    }

    public function showQuestion()
    {
        $questions= SaveQuestion::where('user_id',Auth()->id())->with('questions')->get();
        return inertia('SaveQuestion',[
            'questions' => $questions,
        ]);
    }

   
}
