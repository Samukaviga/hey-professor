<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('shoul be able to open a question to edit', function () {

    // Arrange - preparar

    $user = User::factory()->create();

    $question = Question::factory()->for($user, 'createdBy')->create();

    // Act

    actingAs($user);

    // Assert

    get(route('question.edit', $question))->assertSuccessful();    // Garantir que consigo entrar na rota

});
