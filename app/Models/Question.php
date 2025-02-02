<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = ['question', 'draft'];

    protected $casts = ['draft' => 'bool'];

    // Relacionamento com a tabela 'votes'
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    /*
    // Accessor para calcular o total de likes
    public function likes(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->votes()->sum('like')  // nesse get: fn() => "é possivel adicionar qualquer coisa aqui"
        );
    }

    public function inlikes(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->votes()->sum('inlike')  // nesse get: fn() => "é possivel adicionar qualquer coisa aqui"
        );
    }
    */
}
