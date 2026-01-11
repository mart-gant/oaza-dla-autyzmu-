<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class RateLimitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Rate limiting dla logowania
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->email . '|' . $request->ip())
                ->response(function () {
                    return response()->json([
                        'message' => 'Zbyt wiele prób logowania. Spróbuj ponownie za chwilę.'
                    ], 429);
                });
        });

        // Rate limiting dla rejestracji
        RateLimiter::for('register', function (Request $request) {
            return Limit::perHour(3)
                ->by($request->ip())
                ->response(function () {
                    return response()->json([
                        'message' => 'Zbyt wiele prób rejestracji. Spróbuj ponownie za godzinę.'
                    ], 429);
                });
        });

        // Rate limiting dla formularza kontaktowego
        RateLimiter::for('contact', function (Request $request) {
            return Limit::perHour(3)
                ->by($request->user()?->id ?: $request->ip());
        });

        // Rate limiting dla API
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)
                ->by($request->user()?->id ?: $request->ip());
        });

        // Rate limiting dla postów na forum
        RateLimiter::for('forum-post', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->user()->id);
        });

        // Rate limiting dla recenzji
        RateLimiter::for('review', function (Request $request) {
            return Limit::perDay(10)
                ->by($request->user()->id);
        });
    }
}
