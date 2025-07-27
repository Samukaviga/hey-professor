<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
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
