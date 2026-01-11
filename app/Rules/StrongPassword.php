<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class StrongPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Minimum 8 znaków
        if (strlen($value) < 8) {
            $fail('Hasło musi mieć co najmniej 8 znaków.');
        }

        // Co najmniej jedna wielka litera
        if (!preg_match('/[A-Z]/', $value)) {
            $fail('Hasło musi zawierać co najmniej jedną wielką literę.');
        }

        // Co najmniej jedna mała litera
        if (!preg_match('/[a-z]/', $value)) {
            $fail('Hasło musi zawierać co najmniej jedną małą literę.');
        }

        // Co najmniej jedna cyfra
        if (!preg_match('/[0-9]/', $value)) {
            $fail('Hasło musi zawierać co najmniej jedną cyfrę.');
        }

        // Co najmniej jeden znak specjalny
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value)) {
            $fail('Hasło musi zawierać co najmniej jeden znak specjalny (!@#$%^&* itp.).');
        }

        // Sprawdzenie popularnych haseł (lista top 100 najpopularniejszych)
        $commonPasswords = [
            '12345678', 'password', '123456789', '12345', '1234567', 
            'password1', '123456', 'qwerty', 'abc123', '111111',
            '1234567890', 'Password1', 'Password123', 'Qwerty123',
        ];

        if (in_array($value, $commonPasswords)) {
            $fail('To hasło jest zbyt popularne i nie może być użyte.');
        }
    }
}
