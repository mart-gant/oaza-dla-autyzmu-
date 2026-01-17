<?php

use App\Models\User;
use App\Models\ForumCategory;
use App\Models\ForumTopic;
use App\Models\ForumPost;

test('user can view forum categories', function () {
    ForumCategory::factory()->create(['name' => 'General Discussion']);
    
    $response = $this->get(route('forum.categories'));
    
    $response->assertStatus(200);
    $response->assertSee('General Discussion');
});

test('user can view topics in a category', function () {
    $category = ForumCategory::factory()->create(['name' => 'Support']);
    $topic = ForumTopic::factory()->create([
        'forum_category_id' => $category->id,
        'title' => 'Need Advice',
    ]);
    
    $response = $this->get(route('forum.index', $category));
    
    $response->assertStatus(200);
    $response->assertSee('Need Advice');
});

test('authenticated user can create forum topic', function () {
    $user = User::factory()->create();
    $category = ForumCategory::factory()->create();
    
    $response = $this->actingAs($user)->post(route('forum.store'), [
        'forum_category_id' => $category->id,
        'title' => 'My New Topic',
        'body' => 'This is the content of my topic.',
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseHas('forum_topics', [
        'title' => 'My New Topic',
        'user_id' => $user->id,
        'forum_category_id' => $category->id,
    ]);
    
    $topic = \App\Models\ForumTopic::where('title', 'My New Topic')->first();
    $post = $topic->posts()->first();
    expect($post->body)->toBe('This is the content of my topic.');
    expect($post->user_id)->toBe($user->id);
});

test('unauthenticated user cannot create forum topic', function () {
    $category = ForumCategory::factory()->create();
    
    $response = $this->post(route('forum.store'), [
        'forum_category_id' => $category->id,
        'title' => 'Unauthorized Topic',
        'body' => 'Should not work',
    ]);
    
    $response->assertRedirect(route('login'));
});

test('forum topic title is required', function () {
    $user = User::factory()->create();
    $category = ForumCategory::factory()->create();
    
    $response = $this->actingAs($user)->post(route('forum.store'), [
        'forum_category_id' => $category->id,
        'title' => '',
        'body' => 'Content without title',
    ]);
    
    $response->assertSessionHasErrors('title');
});

test('user can view topic with posts', function () {
    $user = User::factory()->create();
    $category = ForumCategory::factory()->create();
    $topic = ForumTopic::factory()->create([
        'forum_category_id' => $category->id,
        'user_id' => $user->id,
        'title' => 'Test Topic',
    ]);
    
    $post = ForumPost::factory()->create([
        'forum_topic_id' => $topic->id,
        'user_id' => $user->id,
        'body' => 'First post content',
    ]);
    
    $response = $this->get(route('forum.show', $topic));
    
    $response->assertStatus(200);
    $response->assertSee('Test Topic');
    $response->assertSee('First post content');
});

test('user can reply to topic', function () {
    $user = User::factory()->create();
    $topic = ForumTopic::factory()->create();
    
    $response = $this->actingAs($user)->post(route('forum.post.store'), [
        'forum_topic_id' => $topic->id,
        'body' => 'This is my reply',
    ]);
    
    $response->assertRedirect();
    
    $post = $topic->posts()->where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
    expect($post->body)->toBe('This is my reply');
    expect($post->forum_topic_id)->toBe($topic->id);
});

test('user can edit their own post', function () {
    $user = User::factory()->create();
    $post = ForumPost::factory()->create([
        'user_id' => $user->id,
        'body' => 'Original content',
    ]);
    
    $response = $this->actingAs($user)->put(route('forum.post.update', $post), [
        'body' => 'Updated content',
    ]);
    
    $response->assertRedirect();
    
    $post->refresh();
    expect($post->body)->toBe('Updated content');
});

test('user cannot edit another users post', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    
    $post = ForumPost::factory()->create([
        'user_id' => $owner->id,
        'body' => 'Original content',
    ]);
    
    $response = $this->actingAs($otherUser)->put(route('forum.post.update', $post), [
        'body' => 'Hacked content',
    ]);
    
    $response->assertStatus(403);
});

test('admin can edit any post', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $owner = User::factory()->create();
    
    $post = ForumPost::factory()->create([
        'user_id' => $owner->id,
        'body' => 'Original content',
    ]);
    
    $response = $this->actingAs($admin)->put(route('forum.post.update', $post), [
        'body' => 'Admin edited',
    ]);
    
    $response->assertRedirect();
    
    $post->refresh();
    expect($post->body)->toBe('Admin edited');
});

test('user can delete their own post', function () {
    $user = User::factory()->create();
    $post = ForumPost::factory()->create(['user_id' => $user->id]);
    
    $response = $this->actingAs($user)->delete(route('forum.post.destroy', $post));
    
    $response->assertRedirect();
    
    $this->assertDatabaseMissing('forum_posts', [
        'id' => $post->id,
    ]);
});

test('topics can be searched', function () {
    $category = ForumCategory::factory()->create();
    ForumTopic::factory()->create([
        'forum_category_id' => $category->id,
        'title' => 'Autism Therapy Tips'
    ]);
    ForumTopic::factory()->create([
        'forum_category_id' => $category->id,
        'title' => 'School Support'
    ]);
    
    $response = $this->get(route('forum.index', ['category' => $category, 'search' => 'Autism']));
    
    $response->assertSee('Autism Therapy Tips');
});



