<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory; // ele já identifica a Factory QuestionFactory automaticamente

    protected $table = 'questions';

    protected $fillable = ['question'];
}
