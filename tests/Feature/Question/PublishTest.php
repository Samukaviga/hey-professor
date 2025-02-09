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

    $question = Question::factory()->create(['draft' => true]); // criando uma questao

    // Act: agir

    $request = put(route('question.publish', $question))->assertRedirect();

    $question->refresh(); // força o recarregamento  do banco de dados, como já tivemos uma consulta antes, gravamos os dados antes, ele nao entende que teve uma mudança

    // Assert: verificar

    assertDatabaseHas('questions', [
        'draft' => false,
    ]);

    expect($question)->draft->toBeFalse(); // espera que o question seja false, deixa de ser um rascunho

});
