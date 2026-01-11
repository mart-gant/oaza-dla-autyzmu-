<?php

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('conversation can be created between two users', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    $conversation = Conversation::between($user1->id, $user2->id);
    
    expect($conversation)->toBeInstanceOf(Conversation::class);
    expect($conversation->user_1_id)->toBe(min($user1->id, $user2->id));
    expect($conversation->user_2_id)->toBe(max($user1->id, $user2->id));
});

test('conversation between method returns same conversation', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    $conv1 = Conversation::between($user1->id, $user2->id);
    $conv2 = Conversation::between($user2->id, $user1->id);
    
    expect($conv1->id)->toBe($conv2->id);
});

test('conversation can get other user', function () {
    $user1 = User::factory()->create(['name' => 'User One']);
    $user2 = User::factory()->create(['name' => 'User Two']);
    
    $conversation = Conversation::between($user1->id, $user2->id);
    
    $otherUser = $conversation->getOtherUser($user1->id);
    
    expect($otherUser->id)->toBe($user2->id);
    expect($otherUser->name)->toBe('User Two');
});

test('conversation hasUser method works correctly', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $outsider = User::factory()->create();
    
    $conversation = Conversation::between($user1->id, $user2->id);
    
    expect($conversation->hasUser($user1->id))->toBeTrue();
    expect($conversation->hasUser($user2->id))->toBeTrue();
    expect($conversation->hasUser($outsider->id))->toBeFalse();
});

test('message can be marked as read', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    $conversation = Conversation::between($sender->id, $receiver->id);
    
    $message = Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'content' => 'Test message',
    ]);
    
    expect($message->isRead())->toBeFalse();
    
    $message->markAsRead();
    
    expect($message->isRead())->toBeTrue();
    expect($message->read_at)->not->toBeNull();
});

test('message isRead returns correct value', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    $conversation = Conversation::between($sender->id, $receiver->id);
    
    $unreadMessage = Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'content' => 'Unread',
        'read_at' => null,
    ]);
    
    $readMessage = Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'content' => 'Read',
        'read_at' => now(),
    ]);
    
    expect($unreadMessage->isRead())->toBeFalse();
    expect($readMessage->isRead())->toBeTrue();
});

test('unreadFor scope returns only unread messages for user', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    $conversation = Conversation::between($sender->id, $receiver->id);
    
    // 2 unread messages for receiver
    Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'content' => 'Unread 1',
    ]);
    
    Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'content' => 'Unread 2',
    ]);
    
    // 1 read message
    Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'content' => 'Read',
        'read_at' => now(),
    ]);
    
    // 1 message sent by receiver
    Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $receiver->id,
        'receiver_id' => $sender->id,
        'content' => 'Sent by receiver',
    ]);
    
    $unreadCount = Message::unreadFor($receiver->id)->count();
    
    expect($unreadCount)->toBe(2);
});

test('conversation relationships work correctly', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    $conversation = Conversation::between($user1->id, $user2->id);
    
    expect($conversation->user1)->toBeInstanceOf(User::class);
    expect($conversation->user2)->toBeInstanceOf(User::class);
    expect($conversation->messages)->toBeIterable();
});

test('message relationships work correctly', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    $conversation = Conversation::between($sender->id, $receiver->id);
    
    $message = Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'content' => 'Test',
    ]);
    
    expect($message->sender)->toBeInstanceOf(User::class);
    expect($message->receiver)->toBeInstanceOf(User::class);
    expect($message->conversation)->toBeInstanceOf(Conversation::class);
    expect($message->sender->id)->toBe($sender->id);
    expect($message->receiver->id)->toBe($receiver->id);
});
