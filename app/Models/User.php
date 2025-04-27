<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function votes()
    {

        return $this->hasMany(Vote::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'created_by');
    }

    public function like(Question $question)
    {

        $this->votes()->updateOrCreate( // como o relacionamento com a Model Vote, podemos passar diretamente assim
            [
                'question_id' => $question->id, // Atualiza ou cria com base no question_id
            ],
            [
                'like' => 1,
                'inlike' => 0,
            ],
        );
    }

    public function inlike(Question $question)
    {

        $this->votes()->updateOrCreate( // como o relacionamento com a Model Vote, podemos passar diretamente assim
            [
                'question_id' => $question->id, // Atualiza ou cria com base no question_id
            ],
            [
                'like' => 0,
                'inlike' => 1,
            ],
        );
    }
}
