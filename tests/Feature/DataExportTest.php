<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can export their data in json format', function () {
    $user = User::factory()->create([
        'name' => 'Jan Kowalski',
        'email' => 'jan@example.com',
    ]);

    $response = $this->actingAs($user)->get(route('export.user-data'));

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/json');
    
    $data = $response->json();
    expect($data)->toHaveKey('user');
    expect($data['user']['name'])->toBe('Jan Kowalski');
    expect($data['user']['email'])->toBe('jan@example.com');
});

test('exported data includes all user facilities', function () {
    $user = User::factory()->create();
    $facility = \App\Models\Facility::factory()->create([
        'user_id' => $user->id,
        'name' => 'Test Facility',
    ]);

    $response = $this->actingAs($user)->get(route('export.user-data'));

    $data = $response->json();
    expect($data['facilities'])->toHaveCount(1);
    expect($data['facilities'][0]['name'])->toBe('Test Facility');
});

test('exported data includes all user reviews', function () {
    $user = User::factory()->create();
    $facility = \App\Models\Facility::factory()->create();
    $review = \App\Models\Review::factory()->create([
        'user_id' => $user->id,
        'facility_id' => $facility->id,
        'rating' => 5,
    ]);

    $response = $this->actingAs($user)->get(route('export.user-data'));

    $data = $response->json();
    expect($data['reviews'])->toHaveCount(1);
    expect($data['reviews'][0]['rating'])->toBe(5);
});

test('exported data includes forum posts', function () {
    $user = User::factory()->create();
    $category = \App\Models\ForumCategory::factory()->create();
    $topic = \App\Models\ForumTopic::factory()->create([
        'user_id' => $user->id,
        'forum_category_id' => $category->id,
        'title' => 'My Topic',
    ]);

    $response = $this->actingAs($user)->get(route('export.user-data'));

    $data = $response->json();
    expect($data['forum_topics'])->toHaveCount(1);
    expect($data['forum_topics'][0]['title'])->toBe('My Topic');
});

test('user can export data in csv format', function () {
    $user = User::factory()->create([
        'name' => 'Jan Kowalski',
    ]);

    $response = $this->actingAs($user)->get(route('export.user-data', ['format' => 'csv']));

    $response->assertStatus(200);
    expect($response->headers->get('Content-Type'))->toContain('text/csv');
    expect($response->content())->toContain('Jan Kowalski');
});

test('unauthenticated user cannot export data', function () {
    $response = $this->get(route('export.user-data'));

    $response->assertRedirect(route('login'));
});

test('exported data does not include other users data', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create(['name' => 'Other User']);
    
    \App\Models\Facility::factory()->create([
        'user_id' => $otherUser->id,
        'name' => 'Other Facility',
    ]);

    $response = $this->actingAs($user)->get(route('export.user-data'));

    $data = $response->json();
    expect($data['facilities'])->toBeEmpty();
});
