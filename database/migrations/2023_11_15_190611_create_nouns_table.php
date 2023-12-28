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
        Schema::create('nouns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('word_id')->references('id')->on('words');
            $table->string('plural', 64);
            // foreign key of sproperties: but sproperties.id is integer, not biginteger
            $table->integer('genus');
            // foreign key of users
            $table->foreignId('verifiedby')->nullable()->default(null)->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noun');
    }
};
