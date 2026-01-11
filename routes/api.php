<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\ForumController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::prefix('v1')->group(function () {
    // Authentication
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Public facilities (read-only)
    Route::get('/facilities', [FacilityController::class, 'index']);
    Route::get('/facilities/{facility}', [FacilityController::class, 'show']);

    // Public forum topics (read-only)
    Route::get('/forum/topics', [ForumController::class, 'topics']);
    Route::get('/forum/topics/{topic}', [ForumController::class, 'showTopic']);
});

// Protected routes (require JWT authentication)
Route::prefix('v1')->middleware('auth:api')->group(function () {
    // Authentication
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/refresh', [AuthController::class, 'refresh']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Facilities (authenticated)
    Route::post('/facilities', [FacilityController::class, 'store']);
    Route::put('/facilities/{facility}', [FacilityController::class, 'update']);
    Route::delete('/facilities/{facility}', [FacilityController::class, 'destroy']);

    // Forum (authenticated)
    Route::post('/forum/topics', [ForumController::class, 'storeTopic']);
    Route::put('/forum/topics/{topic}', [ForumController::class, 'updateTopic']);
    Route::delete('/forum/topics/{topic}', [ForumController::class, 'destroyTopic']);
    
    Route::post('/forum/topics/{topic}/posts', [ForumController::class, 'storePost']);
    Route::put('/forum/posts/{post}', [ForumController::class, 'updatePost']);
    Route::delete('/forum/posts/{post}', [ForumController::class, 'destroyPost']);
    
    // User search
    Route::get('/users/search', [UserController::class, 'search']);
});

// Rate limiting for API
Route::middleware(['throttle:api'])->group(function () {
    // All API routes are rate limited by default (60 requests per minute)
});
