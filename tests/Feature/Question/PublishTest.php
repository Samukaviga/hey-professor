<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\put;

it('Shold be able to publish a question', function () {

    // Arrange: preparar

    $user = User::factory()->create(); // criar um usuario

    actingAs($user); // logar como esse usuario

    $question = Question::factory()->create(['draft' => true, 'created_by' => $user->id]); // criando uma questao

    // Act: agir

    $request = put(route('question.publish', $question))->assertRedirect();

    $question->refresh(); // força o recarregamento  do banco de dados, como já tivemos uma consulta antes, gravamos os dados antes, ele nao entende que teve uma mudança

    // Assert: verificar

    assertDatabaseHas('questions', [
        'draft' => false,
        'created_by' => $user->id,
    ]);

    expect($question)->draft->toBeFalse(); // espera que o question seja false, deixa de ser um rascunho

});

it('Shold make sure that only the person who has created the question can publish the question', function () {

    // Arrange: preparar

    $rigthUser = User::factory()->create();

    $wrongUser = User::factory()->create();

    actingAs($wrongUser); // logar como esse usuario ERRADO

    // Act: agir
    $question = Question::factory()->create(['draft' => true, 'created_by' => $rigthUser->id]); // criando uma questao com o usuario errado

    put(route('question.publish', $question))->assertForbidden(); // assertForbideen: não permitido

    actingAs($rigthUser); // logando com o usuario certo

    put(route('question.publish', $question))->assertRedirect(); // verifica se tem o redirecionamento

});
