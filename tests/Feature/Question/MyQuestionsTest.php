<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('shold be able to list all questions created by me', function () {

    // Arrange
    $wrongUser = User::factory()->create(); // criando usuario errado
    $user = User::factory()->create();

    actingAs($user); // logando com usuario certo

    /*
    $wrongQuestions = Question::factory()->count(10)->create([ // criando 10 questions com usuario errado
        'question' => str_repeat('*', 8) . '?',
        'created_by' => $wrongUser->id
    ]);


    $questions = Question::factory()->count(10)->create([ // criando 10 questions com usuario certo
        'question' => str_repeat('*', 8) . '?',
        'created_by' => $user->id
    ]);*/

    $wrongQuestions = Question::factory()->for($wrongUser, 'createdBy')->count(10)->create();

    $questions = Question::factory()->for($user, 'createdBy')->count(10)->create();

    // Act
    $response = get(route('question.index'));

    // Assert
    foreach ($questions as $q) { // quero ver as questions que o usuario certo criou

        $response->assertSee($q->question);
    }

    foreach ($wrongQuestions as $q) { // nao quero ver as questions que o usuario errado criou

        $response->assertDontSee($q->question);
    }
});
