<?php

use App\Models\Facility;
use App\Models\User;
use App\Models\Review;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('facility belongs to user', function () {
    $user = User::factory()->create();
    $facility = Facility::factory()->create(['user_id' => $user->id]);
    
    expect($facility->user)->toBeInstanceOf(User::class);
    expect($facility->user->id)->toBe($user->id);
});

test('facility has many reviews', function () {
    $facility = Facility::factory()->create();
    Review::factory()->count(5)->create(['facility_id' => $facility->id]);
    
    expect($facility->reviews)->toHaveCount(5);
    expect($facility->reviews->first())->toBeInstanceOf(Review::class);
});

test('facility fillable attributes work', function () {
    $data = [
        'user_id' => User::factory()->create()->id,
        'name' => 'Test Facility',
        'address' => '123 Test St',
        'city' => 'Warsaw',
        'province' => 'Mazowieckie',
        'postal_code' => '00-001',
        'phone' => '123456789',
        'email' => 'test@facility.com',
        'description' => 'Test description',
    ];
    
    $facility = Facility::create($data);
    
    expect($facility->name)->toBe('Test Facility');
    expect($facility->city)->toBe('Warsaw');
});


test('facility has average rating', function () {
    $facility = Facility::factory()->create();
    
    Review::factory()->create(['facility_id' => $facility->id, 'rating' => 5]);
    Review::factory()->create(['facility_id' => $facility->id, 'rating' => 4]);
    Review::factory()->create(['facility_id' => $facility->id, 'rating' => 3]);
    
    $avgRating = $facility->reviews()->avg('rating');
    
    expect($avgRating)->toBe(4.0);
});
