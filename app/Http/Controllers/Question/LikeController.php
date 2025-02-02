<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use App\Models\Vote;

class LikeController extends Controller
{
    public function __invoke(Question $question)
    {

        /**
         * @var User $user
         */
        $user = auth()->user();

        $user->like($question); // criando o metodo dentro do model que vai tomar uma acao //leitura do codigo fica mais simples

        // auth()->user()->like($question);

        /*
        Vote::query()->create([
            'question_id' => $question->id,
            'user_id' => auth()->id(),
            'like' => 1,
            'inlike' => 0,
        ]);
        */

        return back();
    }
}
