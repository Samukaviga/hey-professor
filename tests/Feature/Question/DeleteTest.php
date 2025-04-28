<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;

it('Shold be able to destroy a question', function () {

    // Arrange: preparar

    $user = User::factory()->create(); // criar um usuario

    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]); // criando uma questao

    actingAs($user); // logar como esse usuario

    // Act: agir

    delete(route('question.destroy', $question))->assertRedirect();

    // Assert: verificar

    assertDatabaseMissing('questions', ['id' => $question->id]);

});

it('Shold make sure that only the person who has destroy the question can publish the question', function () {

    // Arrange: preparar

    $rigthUser = User::factory()->create();

    $wrongUser = User::factory()->create();

    actingAs($wrongUser); // logar como esse usuario ERRADO

    // Act: agir
    $question = Question::factory()->create(['draft' => true, 'created_by' => $rigthUser->id]); // criando uma questao com o usuario errado

    delete(route('question.destroy', $question))->assertForbidden(); // assertForbideen: não permitido

    actingAs($rigthUser); // logando com o usuario certo

    delete(route('question.destroy', $question))->assertRedirect(); // verifica se tem o redirecionamento

});
