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
        'category_id' => $category->id,
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
        'category_id' => $category->id,
        'title' => 'My New Topic',
        'content' => 'This is the content of my topic.',
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseHas('forum_topics', [
        'title' => 'My New Topic',
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);
    
    $this->assertDatabaseHas('forum_posts', [
        'content' => 'This is the content of my topic.',
        'user_id' => $user->id,
    ]);
});

test('unauthenticated user cannot create forum topic', function () {
    $category = ForumCategory::factory()->create();
    
    $response = $this->post(route('forum.store'), [
        'category_id' => $category->id,
        'title' => 'Unauthorized Topic',
        'content' => 'Should not work',
    ]);
    
    $response->assertRedirect(route('login'));
});

test('forum topic title is required', function () {
    $user = User::factory()->create();
    $category = ForumCategory::factory()->create();
    
    $response = $this->actingAs($user)->post(route('forum.store'), [
        'category_id' => $category->id,
        'title' => '',
        'content' => 'Content without title',
    ]);
    
    $response->assertSessionHasErrors('title');
});

test('user can view topic with posts', function () {
    $user = User::factory()->create();
    $category = ForumCategory::factory()->create();
    $topic = ForumTopic::factory()->create([
        'category_id' => $category->id,
        'user_id' => $user->id,
        'title' => 'Test Topic',
    ]);
    
    $post = ForumPost::factory()->create([
        'topic_id' => $topic->id,
        'user_id' => $user->id,
        'content' => 'First post content',
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
        'topic_id' => $topic->id,
        'content' => 'This is my reply',
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseHas('forum_posts', [
        'topic_id' => $topic->id,
        'user_id' => $user->id,
        'content' => 'This is my reply',
    ]);
});

test('user can edit their own post', function () {
    $user = User::factory()->create();
    $post = ForumPost::factory()->create([
        'user_id' => $user->id,
        'content' => 'Original content',
    ]);
    
    $response = $this->actingAs($user)->put(route('forum.post.update', $post), [
        'content' => 'Updated content',
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseHas('forum_posts', [
        'id' => $post->id,
        'content' => 'Updated content',
    ]);
});

test('user cannot edit another users post', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    
    $post = ForumPost::factory()->create([
        'user_id' => $owner->id,
        'content' => 'Original content',
    ]);
    
    $response = $this->actingAs($otherUser)->put(route('forum.post.update', $post), [
        'content' => 'Hacked content',
    ]);
    
    $response->assertStatus(403);
});

test('admin can edit any post', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $owner = User::factory()->create();
    
    $post = ForumPost::factory()->create([
        'user_id' => $owner->id,
        'content' => 'Original content',
    ]);
    
    $response = $this->actingAs($admin)->put(route('forum.post.update', $post), [
        'content' => 'Admin edited',
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseHas('forum_posts', [
        'id' => $post->id,
        'content' => 'Admin edited',
    ]);
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

test('user can delete their own topic', function () {
    $user = User::factory()->create();
    $topic = ForumTopic::factory()->create(['user_id' => $user->id]);
    
    $response = $this->actingAs($user)->delete(route('forum.destroy', $topic));
    
    $response->assertRedirect();
    
    $this->assertDatabaseMissing('forum_topics', [
        'id' => $topic->id,
    ]);
});

test('cannot reply to locked topic', function () {
    $user = User::factory()->create();
    $topic = ForumTopic::factory()->create(['is_locked' => true]);
    
    $response = $this->actingAs($user)->post(route('forum.post.store'), [
        'topic_id' => $topic->id,
        'content' => 'Should not work',
    ]);
    
    $response->assertSessionHasErrors();
});

test('topics can be searched', function () {
    $category = ForumCategory::factory()->create();
    ForumTopic::factory()->create([
        'category_id' => $category->id,
        'title' => 'Autism Therapy Tips'
    ]);
    ForumTopic::factory()->create([
        'category_id' => $category->id,
        'title' => 'School Support'
    ]);
    
    $response = $this->get(route('forum.index', ['category' => $category, 'search' => 'Autism']));
    
    $response->assertSee('Autism Therapy Tips');
});
