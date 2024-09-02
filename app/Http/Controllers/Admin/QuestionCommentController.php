<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PostOwnerMail;
use App\Models\Question;
use App\Models\QuestionComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuestionCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, QuestionComment $questionComment)
    {
        // dd( Auth::id());

        // dd($request->all());
        $data = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:1500',
            'comment' => 'required|string|max:1000',
        ]);


        if ($request->hasFile('image')) {
            $time = time();
            $originalName = $request->file('image')->getClientOriginalName();
            $file_name = $time . '_' . $originalName;
            $filePath = $request->file('image')->storeAs('images', $file_name);
            $data['image'] = $filePath;
        }

        $data['user_id'] = Auth::id();
        // dd($data['question_id']);
        $question = Question::with('user')->find($data['question_id']);

        
        if ($question && $question->user) {
            $owner_post = $question->user->id;
            if ($owner_post !== auth()->id()) {
                Mail::to($question->user->email)->queue(new PostOwnerMail($question));
            }
        }
        // $comment = $data['user_id'] != 
        $questionComment->create($data);

        return back();
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
