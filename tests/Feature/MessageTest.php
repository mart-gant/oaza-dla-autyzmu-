<?php

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;

test('authenticated user can view messages inbox', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)->get(route('messages.index'));
    
    $response->assertStatus(200);
    $response->assertViewIs('messages.index');
    $response->assertViewHas('conversations');
    $response->assertViewHas('unreadCount');
});

test('unauthenticated user cannot view messages inbox', function () {
    $response = $this->get(route('messages.index'));
    
    $response->assertRedirect(route('login'));
});

test('user can send a message', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    
    $response = $this->actingAs($sender)->post(route('messages.store'), [
        'receiver_id' => $receiver->id,
        'content' => 'Hello, this is a test message!',
    ]);
    
    $response->assertRedirect();
    $response->assertSessionHas('success');
    
    $this->assertDatabaseHas('messages', [
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'content' => 'Hello, this is a test message!',
    ]);
    
    $this->assertDatabaseHas('conversations', [
        'user_1_id' => min($sender->id, $receiver->id),
        'user_2_id' => max($sender->id, $receiver->id),
    ]);
});

test('user cannot send message to themselves', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)->post(route('messages.store'), [
        'receiver_id' => $user->id,
        'content' => 'Hello myself!',
    ]);
    
    $response->assertSessionHasErrors('receiver_id');
    
    $this->assertDatabaseMissing('messages', [
        'sender_id' => $user->id,
        'receiver_id' => $user->id,
    ]);
});

test('message content is required', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    
    $response = $this->actingAs($sender)->post(route('messages.store'), [
        'receiver_id' => $receiver->id,
        'content' => '',
    ]);
    
    $response->assertSessionHasErrors('content');
});

test('message content cannot exceed 5000 characters', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    
    $response = $this->actingAs($sender)->post(route('messages.store'), [
        'receiver_id' => $receiver->id,
        'content' => str_repeat('a', 5001),
    ]);
    
    $response->assertSessionHasErrors('content');
});

test('user can view a conversation', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    $conversation = Conversation::between($user1->id, $user2->id);
    
    Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $user1->id,
        'receiver_id' => $user2->id,
        'content' => 'Test message',
    ]);
    
    $response = $this->actingAs($user1)->get(route('messages.show', $conversation));
    
    $response->assertStatus(200);
    $response->assertViewIs('messages.show');
    $response->assertViewHas('conversation');
    $response->assertViewHas('messages');
    $response->assertViewHas('otherUser');
    $response->assertSee('Test message');
});

test('user cannot view conversation they are not part of', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $outsider = User::factory()->create();
    
    $conversation = Conversation::between($user1->id, $user2->id);
    
    $response = $this->actingAs($outsider)->get(route('messages.show', $conversation));
    
    $response->assertStatus(403);
});

test('viewing conversation marks messages as read', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    
    $conversation = Conversation::between($user1->id, $user2->id);
    
    $message = Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $user1->id,
        'receiver_id' => $user2->id,
        'content' => 'Unread message',
        'read_at' => null,
    ]);
    
    expect($message->read_at)->toBeNull();
    
    $this->actingAs($user2)->get(route('messages.show', $conversation));
    
    $message->refresh();
    expect($message->read_at)->not->toBeNull();
});

test('user can search for other users', function () {
    $currentUser = User::factory()->create(['name' => 'John Doe']);
    $searchableUser = User::factory()->create(['name' => 'Jane Smith']);
    $inactiveUser = User::factory()->create(['name' => 'Jane Inactive']);
    
    $token = auth('api')->login($currentUser);
    
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->getJson('/api/v1/users/search?q=Jane');
    
    $response->assertStatus(200);
    $response->assertJsonFragment(['name' => 'Jane Smith']);
});

test('unread message count is accurate', function () {
    $user = User::factory()->create();
    $sender1 = User::factory()->create();
    $sender2 = User::factory()->create();
    
    $conv1 = Conversation::between($user->id, $sender1->id);
    $conv2 = Conversation::between($user->id, $sender2->id);
    
    // 2 unread from sender1
    Message::create([
        'conversation_id' => $conv1->id,
        'sender_id' => $sender1->id,
        'receiver_id' => $user->id,
        'content' => 'Unread 1',
    ]);
    
    Message::create([
        'conversation_id' => $conv1->id,
        'sender_id' => $sender1->id,
        'receiver_id' => $user->id,
        'content' => 'Unread 2',
    ]);
    
    // 1 unread from sender2
    Message::create([
        'conversation_id' => $conv2->id,
        'sender_id' => $sender2->id,
        'receiver_id' => $user->id,
        'content' => 'Unread 3',
    ]);
    
    // 1 read message
    Message::create([
        'conversation_id' => $conv1->id,
        'sender_id' => $sender1->id,
        'receiver_id' => $user->id,
        'content' => 'Read message',
        'read_at' => now(),
    ]);
    
    $response = $this->actingAs($user)->get(route('messages.index'));
    
    $response->assertViewHas('unreadCount', 3);
});
