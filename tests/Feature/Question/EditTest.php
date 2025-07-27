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

it('shold make sure that only user that created the question can edit the question', function () {

    // Arrange: preparar

    $rigthUser = User::factory()->create();

    $wrongUser = User::factory()->create();

    actingAs($wrongUser); // logar como esse usuario ERRADO

    // Act: agir
    $question = Question::factory()->create(['draft' => true, 'created_by' => $rigthUser->id]); // criando uma questao com o usuario errado

    get(route('question.edit', $question))->assertForbidden(); // assertForbideen: não permitido

    actingAs($rigthUser); // logando com o usuario certo

    get(route('question.edit', $question))->assertSuccessful(); // verifica se foi um sucesso

});
