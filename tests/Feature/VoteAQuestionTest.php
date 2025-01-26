<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('Shold be able to like a question', function () {

    // Arrange: preparar

    $user = User::factory()->create();

    $question = Question::factory()->create();

    actingAs($user);

    // Act: agir

    post(route('question.like', $question))->assertRedirect(); // AssertRedirect, esta verificando o redirecionamento

    // Assert: verificar

    assertDatabaseHas('votes', [

        'question_id' => $question->id,
        'user_id' => $user->id,
        'like' => 1,
        'inlike' => 0,

    ]);
});

it('Should not be able to like more than 1 time', function () {

    // Arrange: preparar

    $user = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    // Act: agir

    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));

    // Assert

    expect($user->votes()->where('question_id', '=', $question->id)->get())->toHaveCount(1); // espera que os votos do usuario tenha 1 e nao mais
});
