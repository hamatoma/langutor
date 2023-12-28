<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WordListLowercase implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $match = null;
        if (preg_match('/[^a-z ]/', $value, $match)) {
            $fail("The word list :attribute contains a wrong character: :char")
                ->translate(['char' => $match[0]]);
        }
    }
}
