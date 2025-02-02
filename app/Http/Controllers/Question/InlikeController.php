<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InlikeController extends Controller
{
    public function __invoke(Question $question)
    {

        /**
         * @var User $user
         */
        $user = Auth::user();

        $user->inlike($question);

        return back();
    }
}
