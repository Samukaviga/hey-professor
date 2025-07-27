<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('shoul be able to open a question to edit', function () {

    // Arrange - preparar

    $user = User::factory()->create();

    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    // Act

    actingAs($user);

    // Assert

    get(route('question.edit', $question))->assertSuccessful();    // Garantir que consigo entrar na rota

});

it('shold return a view', function () {

    // Arrange - preparar

    $user = User::factory()->create();

    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    // Act

    actingAs($user);

    // Assert

    get(route('question.edit', $question))->assertViewIs('question.edit');   // verifica se acessa a view

});

it('shold make sure that only question with status DRAFT can be edited', function () {

    // Arrange - preparar

    $user = User::factory()->create();

    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);

    $draftQuestion = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    // Act

    actingAs($user);

    // Assert
    get(route('question.edit', $questionNotDraft))->assertForbidden();   // verifica que o usuerio não tem permissao para a alteração 403

    get(route('question.edit', $draftQuestion))->assertSuccessful(); // Verifica se retorna sucesso

});
