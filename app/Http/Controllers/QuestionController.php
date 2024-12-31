<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Closure;

class QuestionController extends Controller
{
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {

                    if ($value[strlen($value) - 1] != '?') {

                        $fail("Are you sure that is a question ? It is missing the question mark in the end.");
                    }
                }
            ]
        ]);


        Question::query()->create($attributes);


        return to_route('dashboard');
    }
}
