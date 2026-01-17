<?php

use App\Models\User;
use App\Models\Facility;
use App\Models\Review;
use App\Models\ForumTopic;
use App\Models\ForumPost;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('user has correct default role', function () {
    $user = User::factory()->create();
    
    expect($user->role)->toBe('parent');
});

test('user can check if they are admin', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'parent']);
    
    expect($admin->role)->toBe('admin');
    expect($user->role)->toBe('parent');
});

test('user can have facilities', function () {
    $user = User::factory()->create();
    Facility::factory()->count(3)->create(['user_id' => $user->id]);
    
    expect($user->facilities)->toHaveCount(3);
    expect($user->facilities->first())->toBeInstanceOf(Facility::class);
});

test('user can have reviews', function () {
    $user = User::factory()->create();
    $facility = Facility::factory()->create();
    
    Review::factory()->count(2)->create([
        'user_id' => $user->id,
        'facility_id' => $facility->id,
    ]);
    
    expect($user->reviews)->toHaveCount(2);
    expect($user->reviews->first())->toBeInstanceOf(Review::class);
});

test('user can have forum topics', function () {
    $user = User::factory()->create();
    ForumTopic::factory()->count(3)->create(['user_id' => $user->id]);
    
    expect($user->forumTopics)->toHaveCount(3);
    expect($user->forumTopics->first())->toBeInstanceOf(ForumTopic::class);
});

test('user can have forum posts', function () {
    $user = User::factory()->create();
    ForumPost::factory()->count(5)->create(['user_id' => $user->id]);
    
    expect($user->forumPosts)->toHaveCount(5);
    expect($user->forumPosts->first())->toBeInstanceOf(ForumPost::class);
});

test('user can have messages sent', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    
    $conversation = \App\Models\Conversation::between($sender->id, $receiver->id);
    
    \App\Models\Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'content' => 'Test message',
    ]);
    
    expect($sender->sentMessages)->toHaveCount(1);
    expect($receiver->receivedMessages)->toHaveCount(1);
});

test('user can be suspended', function () {
    $user = User::factory()->create(['is_suspended' => true]);
    
    expect($user->is_suspended)->toBeTrue();
});

test('user password is hashed', function () {
    $user = User::factory()->create(['password' => 'plaintext']);
    
    expect($user->password)->not->toBe('plaintext');
    expect(strlen($user->password))->toBeGreaterThan(20);
});

test('user email is verified correctly', function () {
    $verified = User::factory()->create(['email_verified_at' => now()]);
    $unverified = User::factory()->create(['email_verified_at' => null]);
    
    expect($verified->hasVerifiedEmail())->toBeTrue();
    expect($unverified->hasVerifiedEmail())->toBeFalse();
});

test('user casts work correctly', function () {
    $user = User::factory()->create([
        'email_verified_at' => '2026-01-01 12:00:00',
    ]);
    
    expect($user->email_verified_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
});

test('user fillable attributes can be mass assigned', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'role' => 'therapist',
    ];
    
    $user = User::create($data);
    
    expect($user->name)->toBe('Test User');
    expect($user->email)->toBe('test@example.com');
    expect($user->role)->toBe('therapist');
});

test('user hidden attributes are not in array', function () {
    $user = User::factory()->create();
    $array = $user->toArray();
    
    expect($array)->not->toHaveKey('password');
    expect($array)->not->toHaveKey('remember_token');
});
