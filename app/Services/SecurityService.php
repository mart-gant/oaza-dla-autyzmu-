<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SecurityService
{
    /**
     * Sprawdza czy IP jest na czarnej liście
     */
    public function isIpBlacklisted(string $ip): bool
    {
        // Tu możesz zintegrować z zewnętrzną usługą sprawdzania IP
        // Na razie zwracamy false
        return false;
    }

    /**
     * Walidacja i czyszczenie danych wejściowych
     */
    public function sanitizeInput(string $input): string
    {
        // Usuń HTML tags
        $input = strip_tags($input);
        
        // Usuń whitespace
        $input = trim($input);
        
        return $input;
    }

    /**
     * Sprawdza siłę hasła
     */
    public function calculatePasswordStrength(string $password): array
    {
        $strength = 0;
        $feedback = [];

        // Długość
        if (strlen($password) >= 8) {
            $strength += 20;
        } else {
            $feedback[] = 'Hasło powinno mieć co najmniej 8 znaków';
        }

        if (strlen($password) >= 12) {
            $strength += 10;
        }

        // Wielkie litery
        if (preg_match('/[A-Z]/', $password)) {
            $strength += 20;
        } else {
            $feedback[] = 'Dodaj wielką literę';
        }

        // Małe litery
        if (preg_match('/[a-z]/', $password)) {
            $strength += 20;
        } else {
            $feedback[] = 'Dodaj małą literę';
        }

        // Cyfry
        if (preg_match('/[0-9]/', $password)) {
            $strength += 20;
        } else {
            $feedback[] = 'Dodaj cyfrę';
        }

        // Znaki specjalne
        if (preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $strength += 10;
        } else {
            $feedback[] = 'Dodaj znak specjalny';
        }

        // Określ poziom
        $level = 'weak';
        if ($strength >= 80) {
            $level = 'strong';
        } elseif ($strength >= 60) {
            $level = 'medium';
        }

        return [
            'strength' => $strength,
            'level' => $level,
            'feedback' => $feedback,
        ];
    }

    /**
     * Loguje akcję bezpieczeństwa
     */
    public function logSecurityEvent(string $event, array $data = []): void
    {
        Log::channel('security')->info($event, array_merge($data, [
            'timestamp' => now(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_id' => auth()->id(),
        ]));
    }

    /**
     * Sprawdza czy request pochodzi z bezpiecznego źródła
     */
    public function isSecureRequest(): bool
    {
        $request = request();
        
        // Sprawdź HTTPS w produkcji
        if (config('app.env') === 'production' && !$request->secure()) {
            return false;
        }

        // Sprawdź CSRF token
        if (!$request->session()->token()) {
            return false;
        }

        return true;
    }

    /**
     * Generuje bezpieczny token
     */
    public function generateSecureToken(int $length = 32): string
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Maskuje wrażliwe dane (np. email)
     */
    public function maskEmail(string $email): string
    {
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return $email;
        }

        $username = $parts[0];
        $domain = $parts[1];

        $maskedUsername = substr($username, 0, 2) . str_repeat('*', strlen($username) - 2);

        return $maskedUsername . '@' . $domain;
    }

    /**
     * Sprawdza czy użytkownik przekroczył limit akcji
     */
    public function checkActionLimit(string $action, int $limit, int $minutes = 60): bool
    {
        $key = 'action_limit:' . auth()->id() . ':' . $action;
        $attempts = cache()->get($key, 0);

        if ($attempts >= $limit) {
            return false;
        }

        cache()->put($key, $attempts + 1, now()->addMinutes($minutes));
        return true;
    }
}
