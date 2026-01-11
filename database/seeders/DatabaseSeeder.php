<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@oaza.pl',
            'password' => bcrypt('Admin@Oaza2026!Secure#'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create test users for different roles
        User::factory()->create([
            'name' => 'Jan Kowalski',
            'email' => 'jan@example.com',
            'password' => bcrypt('password'),
            'role' => 'autistic_person',
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Anna Nowak',
            'email' => 'anna@example.com',
            'password' => bcrypt('password'),
            'role' => 'parent',
            'email_verified_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Dr Maria Wiśniewska',
            'email' => 'maria@example.com',
            'password' => bcrypt('password'),
            'role' => 'therapist',
            'is_specialist' => true,
            'specialization' => 'Terapia behawioralna, ABA',
            'description' => 'Specjalistka z 10-letnim doświadczeniem w pracy z osobami ze spektrum autyzmu.',
            'email_verified_at' => now(),
        ]);

        $this->call(FacilitySeeder::class);
        $this->call(SpecialistSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(ForumSeeder::class);
    }
}
