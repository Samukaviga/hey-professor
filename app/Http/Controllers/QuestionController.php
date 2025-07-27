<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        return view('question.index', ['questions' => Auth::user()->questions]); // faz o filtro das questions do usuario logado
    }

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

        return back();
    }

    public function edit(Question $question)
    {
        $this->authorize('update', $question);

        return view('question.edit', compact('question'));

    }
    /*
    public function update(Request $request)
    {

    } */

    public function destroy(Question $question)
    {
        $this->authorize('destroy', $question); // usuario tem autorização de deletar essa perguntar ?

        $question->delete();

        return back();

    }
}
