<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $genders = ["ไม่ระบุ", "ชาย", "หญิง"];
        foreach ($genders as $gender) {
            Gender::updateOrcreate(["name" => $gender]);
        }

        User::updateOrcreate([
            'name' => env('ADMIN_USER'),
            'email' => env('ADMIN_EMAIL'),
        ], [
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'avatar_url' => "avatars/beaver.png",
            'first_name' => Str::ucfirst(env('ADMIN_USER')),
            'last_name' => '',
        ]);
    }
}
