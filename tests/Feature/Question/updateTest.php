<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\put;

it('should update the question in the database', function () {

    $user = User::factory()->create();

    actingAs($user);

    $question = Question::factory()->create(['draft' => true, 'created_by' => $user]);

    put(route('question.update', $question), [
        'question' => 'Updated question ?',
    ])->assertRedirect();

    $question->refresh(); // recarrega tudo de novo no BD

    expect($question)->question->toBe('Updated question ?'); // verifica se tem o valor no BD

});

it('should only question with status DRAFT can be updated', function () {

    $user = User::factory()->create();

    actingAs($user);

    $questionNotDraft = Question::factory()->create(['created_by' => $user, 'draft' => false]);

    $draftQuestion = Question::factory()->create(['created_by' => $user, 'draft' => true]);

    put(route('question.update', $questionNotDraft), ['question' => 'This is a question ?'])->assertForbidden();

    put(route('question.update', $draftQuestion), ['question' => 'This is a question ?'])->assertRedirect();

});

it('Should make sure only user that created a question can updated the question', function () {

    $rightUser = User::factory()->create();

    $wronguser = user::factory()->create();

    actingAs($rightUser);

    // act

    $question = Question::factory()->create(['created_by' => $rightUser, 'draft' => true]);

    put(route('question.update', $question), ['question' => 'This is a new questions for my friendy ?'])->assertRedirect();

    actingAs($wronguser);

    put(route('question.update', $question), ['question' => 'this is a new question ?'])->assertForbidden();

});

it('Shold question updated have at least 10 characters', function () {

    // Arrange: preparar

    $user = User::factory()->create(); // criar um usuario

    actingAs($user); // logar como esse usuario

    $question = Question::factory()->create(['created_by' => $user, 'draft' => true]);

    // Act: agir

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 8).'?',
    ]);

    // Assert: verificar

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]); // verifica se tem algum erro relacionado

    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);

});

it('Should check if question updated ends with mark ?', function () {

    // Arrange: preparar

    $user = User::factory()->create(); // criar um usuario

    actingAs($user); // logar como esse usuario

    $question = Question::factory()->create(['created_by' => $user, 'draft' => true]);

    // Act: agir

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 10),
    ]);

    // Assert: verificar

    $request->assertSessionHasErrors(['question' => 'Are you sure that is a question ? It is missing the question mark in the end.']); // verifica se tem algum erro relacionado

    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]); // verifica se a pergunta permanece a mesma

});

it('Shold be able to update a new question bigger than 255 characters', function () {

    // Arrange: preparar

    $user = User::factory()->create(); // criar um usuario

    actingAs($user); // logar como esse usuario

    $question = Question::factory()->create(['created_by' => $user, 'draft' => true]);

    // Act: agir

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 260).'?',
    ]);

    // Assert: verificar

    $request->assertRedirect(); // redirecionando

    assertDatabaseHas('questions', ['question' => str_repeat('*', 260).'?']); // tenha uma pergunta com 260 caracteres seguida de ?

});
