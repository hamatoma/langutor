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
        Schema::create('verbs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('word_id')->references('id')->on('words');
            $table->string('presence', 128);
            $table->string('imperfect', 128);
            $table->string('participle', 64);
            $table->string('separablepart', 16);
            $table->foreignId('verifiedby')->nullable()->default(null)->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verbs');
    }
};
