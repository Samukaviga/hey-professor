<?php

use App\Models\Question;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\get;

it('should lista all the questions', function () {

    // Arrange: preparar

    $user = User::factory()->create();

    actingAs($user);

    $questions = Question::factory()->count(5)->create(); // criando 5 questions

    // Act: Agir

    $response = get(route('dashboard'));

    // Assert: verificar

    /** @var Question $q */
    foreach ($questions as $q) {

        $response->assertSee($q->question);
    }

    assertDatabaseCount('questions', 5);
});

it('should paginate the result', function () {

    $user = User::factory()->create();

    actingAs($user);

    $questios = Question::factory()->count(20)->create();

    get(route('dashboard'))
        ->assertViewHas('questions', fn ($value) => $value instanceof LengthAwarePaginator);

});
