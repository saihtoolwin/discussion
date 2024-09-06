<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaveQuestion;
use Illuminate\Http\Request;

class SaveQuestionController extends Controller
{
    public function saveQuestion($id,SaveQuestion $saveQuestion)
    {
        $saveQuestion->create([
            'user_id' => Auth()->id(),
            'question_id' => $id,
        ]);
        return back();
        
    }

    public function deleteSaveQuestion($id,SaveQuestion $saveQuestion)
    {
        // dd($id);
        $saveQuestion->where('question_id',$id)->delete();
        return back();
    }
}
