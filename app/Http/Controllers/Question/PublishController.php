<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PublishController extends Controller
{
    public function __invoke(Question $question)
    {

        $this->authorize('publish', $question); // Voce me autoriza a publicar essa pergunta ?

        // OU

        // abort_unless(Auth::user()->can('publish', $question), Response::HTTP_FORBIDDEN); // Ao menos que o usuario possa publicar essa pergunta retorne o erro 403 que é o FORBIDDEN

        // Quando fomos usar essa abilities: 'publish'. Tenho que garantir que o meu QuestionPolicy tem uma funcao com o nome 'publish'
        // Polices: sao regras que voce colocar de autorização de quem pode e qum nao pode em cima de um Model

        $question->update(['draft' => false]);

        return back();
    }
}
