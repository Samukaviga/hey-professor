<?php

use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Str;

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
    /*
    $question->refresh();

     $this->assertTrue(
        Str::endsWith($question->question, '?'),
    );*/

    actingAs($wronguser);

    put(route('question.update', $question), ['question' => 'this is a new question ?'])->assertForbidden();

});
