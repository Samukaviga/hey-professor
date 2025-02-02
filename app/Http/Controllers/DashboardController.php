<?php

namespace App\Http\Controllers;

use App\Models\Question;

class DashboardController extends Controller
{
    public function __invoke() // é chamada assim que a classe é instanciada
    {

        $questions = Question::withSum('votes', 'like')->withSum('votes', 'inlike')->get();

        return view('dashboard', [
            'questions' => $questions,
        ]);
    }
}
