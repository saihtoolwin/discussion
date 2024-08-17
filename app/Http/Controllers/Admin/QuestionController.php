<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\Question as QuestionTraits;

use function Termwind\render;

class QuestionController extends Controller
{
    use QuestionTraits;
    public function index($slug)
    {
        $questions = Question::where('slug',$slug)->with('user', 'comment.user', 'like', 'questionSave', 'tag')->get();
        foreach ($questions as $question) {
            $likeDetails = $this->getlikeDetails($question->id);
            $question->is_like = $likeDetails['is_like'];
            $question->like_count = $likeDetails['like_count'];
        }
        // return response()->json(['question'=>$questions]);

        return Inertia::render('QuestionDetail', [
            'questions' => $questions,
        ]);
    }

    public function create()
    {
        $tags=Tag::all();
        return Inertia::render('CreateQuestion',[
            'tags' => $tags,
        ]);
    }

    public function store(Request $request,Question $question)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'question' => 'required|string',
            'tags' => 'array', 
            'tags.*' => 'integer|exists:tags,id',
        ]);
    
        $question = Question::create([
            'title' => $validatedData['title'],
            'slug' => \Str::slug($validatedData['title']),
            'description' => $validatedData['question'],
            'user_id' => auth()->id(),
        ]);

        if($validatedData['tags'])
        {
            $tags=Tag::whereIn('id',$validatedData['tags'])->pluck('id');
            // dd($tags);
            $question->tag()->attach($tags);
        }

        return to_route('home.index');
    }
}
