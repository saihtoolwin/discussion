<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionLikeController extends Controller
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
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'question_id' => 'required|integer|exists:questions,id',
        ]);

        QuestionLike::create([
            'question_id' => $data['question_id'],
            'user_id' => Auth::user()->id,
        ]);
    
        // $questionLike->store([
        //     'question_id' => $request->id,
        //     'user_id' => Auth::user()->id,
        // ]);
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
    public function destroy(string $id,QuestionLike $questionLike)
    {
        $like = QuestionLike::where('question_id', $id)->where('user_id',Auth::id())->first();
        if ($like) {
            $like->delete();
            // return response()->json(['message' => 'Like deleted successfully.'], 200);
        }
        return back();
    }
}
