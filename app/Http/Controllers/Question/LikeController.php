<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Vote;

class LikeController extends Controller
{
    public function __invoke(Question $question)
    {

        Vote::query()->create([
            'question_id' => $question->id,
            'user_id' => auth()->id(),
            'like' => 1,
            'inlike' => 0,
        ]);

        return back();
    }
}
