<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;


it('Shold be able to create a new question bigger than 255 characters', function () {

    // Arrange: preparar

    $user = User::factory()->create(); //criar um usuario

    actingAs($user); //logar como esse usuario

    //Act: agir

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    //Assert: verificar

    $request->assertRedirect('dashboard'); //redirecionando

    assertDatabaseCount('questions', 1); //tenha pelo menos 1 registro na table question

    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']); //tenha uma pergunta com 260 caracteres seguida de ?


});

it('Shold check if ends with question mark ?', function () {

    // Arrange: preparar

    $user = User::factory()->create(); //criar um usuario

    actingAs($user); //logar como esse usuario


    //Act: agir

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    //Assert: verificar

    $request->assertSessionHasErrors(['question' => 'Are you sure that is a question ? It is missing the question mark in the end.']); //verifica se tem algum erro relacionado
    assertDatabaseCount('questions', 0); //tenha nenhum registro na tabela

});

it('Shold have at least 10 characters', function () {


    // Arrange: preparar

    $user = User::factory()->create(); //criar um usuario

    actingAs($user); //logar como esse usuario


    //Act: agir

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    //Assert: verificar

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]); //verifica se tem algum erro relacionado
    assertDatabaseCount('questions', 0); //tenha nenhum registro na tabela

});
