<?php

use App\Models\User;
use App\Models\Facility;
use App\Models\Review;

test('authenticated user can create facility', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)->post(route('facilities.store'), [
        'name' => 'Test Facility',
        'type' => 'therapist',
        'address' => '123 Test St',
        'city' => 'Warsaw',
        'postal_code' => '00-001',
        'phone' => '123456789',
        'email' => 'test@facility.com',
        'description' => 'A test facility for autism support.',
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseHas('facilities', [
        'name' => 'Test Facility',
        'type' => 'therapist',
        'city' => 'Warsaw',
        'user_id' => $user->id,
    ]);
});

test('facility name is required', function () {
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)->post(route('facilities.store'), [
        'type' => 'therapist',
        'city' => 'Warsaw',
    ]);
    
    $response->assertSessionHasErrors('name');
});

test('user can view facility details', function () {
    $facility = Facility::factory()->create([
        'name' => 'View Test Facility',
    ]);
    
    $response = $this->get(route('facilities.show', $facility));
    
    $response->assertStatus(200);
    $response->assertSee('View Test Facility');
});

test('user can update their own facility', function () {
    $user = User::factory()->create();
    $facility = Facility::factory()->create([
        'user_id' => $user->id,
        'name' => 'Old Name',
    ]);
    
    $response = $this->actingAs($user)->put(route('facilities.update', $facility), [
        'name' => 'Updated Name',
        'type' => $facility->type,
        'address' => $facility->address,
        'city' => $facility->city,
        'postal_code' => $facility->postal_code,
        'phone' => $facility->phone,
        'email' => $facility->email,
        'description' => $facility->description,
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseHas('facilities', [
        'id' => $facility->id,
        'name' => 'Updated Name',
    ]);
});

test('user cannot update another users facility', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    
    $facility = Facility::factory()->create(['user_id' => $owner->id]);
    
    $response = $this->actingAs($otherUser)->put(route('facilities.update', $facility), [
        'name' => 'Hacked Name',
        'type' => $facility->type,
        'address' => $facility->address,
        'city' => $facility->city,
        'postal_code' => $facility->postal_code,
        'phone' => $facility->phone,
        'email' => $facility->email,
        'description' => $facility->description,
    ]);
    
    $response->assertStatus(403);
});

test('admin can update any facility', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $owner = User::factory()->create();
    
    $facility = Facility::factory()->create(['user_id' => $owner->id, 'name' => 'Old Name']);
    
    $response = $this->actingAs($admin)->put(route('facilities.update', $facility), [
        'name' => 'Admin Updated',
        'type' => $facility->type,
        'address' => $facility->address,
        'city' => $facility->city,
        'postal_code' => $facility->postal_code,
        'phone' => $facility->phone,
        'email' => $facility->email,
        'description' => $facility->description,
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseHas('facilities', [
        'id' => $facility->id,
        'name' => 'Admin Updated',
    ]);
});

test('user can delete their own facility', function () {
    $user = User::factory()->create();
    $facility = Facility::factory()->create(['user_id' => $user->id]);
    
    $response = $this->actingAs($user)->delete(route('facilities.destroy', $facility));
    
    $response->assertRedirect();
    
    $this->assertDatabaseMissing('facilities', [
        'id' => $facility->id,
    ]);
});

test('facility list can be filtered by type', function () {
    Facility::factory()->create(['type' => 'therapist', 'name' => 'Therapist 1']);
    Facility::factory()->create(['type' => 'school', 'name' => 'School 1']);
    
    $response = $this->get(route('facilities.index', ['type' => 'therapist']));
    
    $response->assertStatus(200);
    $response->assertSee('Therapist 1');
    $response->assertDontSee('School 1');
});

test('facility list can be filtered by city', function () {
    Facility::factory()->create(['city' => 'Warsaw', 'name' => 'Warsaw Facility']);
    Facility::factory()->create(['city' => 'Krakow', 'name' => 'Krakow Facility']);
    
    $response = $this->get(route('facilities.index', ['city' => 'Warsaw']));
    
    $response->assertStatus(200);
    $response->assertSee('Warsaw Facility');
    $response->assertDontSee('Krakow Facility');
});

test('facility can be searched by name', function () {
    Facility::factory()->create(['name' => 'Autism Center Warsaw']);
    Facility::factory()->create(['name' => 'Therapy Office Krakow']);
    
    $response = $this->get(route('facilities.index', ['search' => 'Autism']));
    
    $response->assertStatus(200);
    $response->assertSee('Autism Center Warsaw');
});

test('user can add review to facility', function () {
    $user = User::factory()->create();
    $facility = Facility::factory()->create();
    
    $response = $this->actingAs($user)->post(route('reviews.store'), [
        'facility_id' => $facility->id,
        'rating' => 5,
        'comment' => 'Excellent facility!',
    ]);
    
    $response->assertRedirect();
    
    $this->assertDatabaseHas('reviews', [
        'facility_id' => $facility->id,
        'user_id' => $user->id,
        'rating' => 5,
        'comment' => 'Excellent facility!',
    ]);
});
