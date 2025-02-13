<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

                        $fail('Are you sure that is a question ? It is missing the question mark in the end.');
                    }
                },
            ],
        ]);

        Auth::user()->questions()->create(  // através desse relacionamento que já esta vinculado com o created_by, nao precisará lista esse atributo como parametro
            [
                'question' => $request->question,
                'draft' => true,
            ]
        );

        return to_route('dashboard');
    }
}
