<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;

class QuestionPolicy
{
    public function publish(User $user, Question $question): bool
    {
        return $question->createdBy()->is($user); // criador da pergunta é o mesmo do usuario logado ?
    }

    public function destroy(User $user, Question $question): bool
    {
        return $question->createdBy()->is($user); // criador da pergunta é o mesmo do usuario logado ?
    }

    public function update(User $user, Question $question)
    {
        return $question->draft && $question->createdBy()->is($user);  // a pergunta é um rascunho e foi criada pelo usuario logado ?
    }
}
