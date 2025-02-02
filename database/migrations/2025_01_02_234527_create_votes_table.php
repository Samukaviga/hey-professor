<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id')->nullable(); // nao pode ser vazio
            $table->foreign('question_id')->references('id')->on('questions')->cascadeOnDelete();
            $table->unsignedBigInteger('user_id')->nullable(); // nao pode ser vazio
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedSmallInteger('like')->default(0);
            $table->unsignedSmallInteger('inlike')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
