<?php

use App\Models\Event;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('authenticated user can create event', function () {
    $user = User::factory()->create();
    $facility = Facility::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->post(route('events.store'), [
        'title' => 'Warsztat dla rodziców',
        'description' => 'Warsztat o metodach terapeutycznych',
        'start_date' => now()->addDays(7)->format('Y-m-d H:i:s'),
        'end_date' => now()->addDays(7)->addHours(3)->format('Y-m-d H:i:s'),
        'location' => 'Warszawa',
        'facility_id' => $facility->id,
        'is_public' => true,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('events', [
        'title' => 'Warsztat dla rodziców',
        'user_id' => $user->id,
    ]);
});

test('event title is required', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('events.store'), [
        'start_date' => now()->addDays(7)->format('Y-m-d H:i:s'),
    ]);

    $response->assertSessionHasErrors('title');
});

test('event start date must be in future', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('events.store'), [
        'title' => 'Wydarzenie',
        'start_date' => now()->subDays(1)->format('Y-m-d H:i:s'),
    ]);

    $response->assertSessionHasErrors('start_date');
});

test('user can view public events', function () {
    $user = User::factory()->create();
    Event::factory()->create([
        'user_id' => $user->id,
        'title' => 'Publiczne wydarzenie',
        'is_public' => true,
        'start_date' => now()->addDays(7),
    ]);

    $response = $this->get(route('events.index'));

    $response->assertStatus(200);
    $response->assertSee('Publiczne wydarzenie');
});

test('user cannot view private events of other users', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    
    $privateEvent = Event::factory()->create([
        'user_id' => $otherUser->id,
        'title' => 'Prywatne wydarzenie',
        'is_public' => false,
        'start_date' => now()->addDays(7),
    ]);

    $response = $this->actingAs($user)->get(route('events.show', $privateEvent));

    $response->assertStatus(403);
});

test('user can update their own event', function () {
    $user = User::factory()->create();
    $event = Event::factory()->create([
        'user_id' => $user->id,
        'title' => 'Stary tytuł',
        'start_date' => now()->addDays(7),
    ]);

    $response = $this->actingAs($user)->put(route('events.update', $event), [
        'title' => 'Nowy tytuł',
        'start_date' => now()->addDays(7)->format('Y-m-d H:i:s'),
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('events', [
        'id' => $event->id,
        'title' => 'Nowy tytuł',
    ]);
});

test('user cannot update another users event', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    
    $event = Event::factory()->create([
        'user_id' => $otherUser->id,
        'title' => 'Wydarzenie',
        'start_date' => now()->addDays(7),
    ]);

    $response = $this->actingAs($user)->put(route('events.update', $event), [
        'title' => 'Hacked',
        'start_date' => now()->addDays(7)->format('Y-m-d H:i:s'),
    ]);

    $response->assertStatus(403);
});

test('admin can update any event', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create();
    
    $event = Event::factory()->create([
        'user_id' => $user->id,
        'title' => 'Stary tytuł',
        'start_date' => now()->addDays(7),
    ]);

    $response = $this->actingAs($admin)->put(route('events.update', $event), [
        'title' => 'Admin Updated',
        'start_date' => now()->addDays(7)->format('Y-m-d H:i:s'),
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('events', [
        'id' => $event->id,
        'title' => 'Admin Updated',
    ]);
});

test('user can delete their own event', function () {
    $user = User::factory()->create();
    $event = Event::factory()->create([
        'user_id' => $user->id,
        'start_date' => now()->addDays(7),
    ]);

    $response = $this->actingAs($user)->delete(route('events.destroy', $event));

    $response->assertRedirect();
    $this->assertDatabaseMissing('events', ['id' => $event->id]);
});

test('events can be filtered by facility', function () {
    $user = User::factory()->create();
    $facility = Facility::factory()->create(['user_id' => $user->id]);
    
    Event::factory()->create([
        'user_id' => $user->id,
        'facility_id' => $facility->id,
        'title' => 'Wydarzenie przy placówce',
        'is_public' => true,
        'start_date' => now()->addDays(7),
    ]);
    
    Event::factory()->create([
        'user_id' => $user->id,
        'facility_id' => null,
        'title' => 'Inne wydarzenie',
        'is_public' => true,
        'start_date' => now()->addDays(7),
    ]);

    $response = $this->get(route('events.index', ['facility_id' => $facility->id]));

    $response->assertStatus(200);
    $response->assertSee('Wydarzenie przy placówce');
    $response->assertDontSee('Inne wydarzenie');
});
