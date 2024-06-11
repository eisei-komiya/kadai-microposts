<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Micropost;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        User::factory(10)->create()->each(function ($user) {
            foreach ($user->categories as $category) {
                Micropost::factory(1)->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id
                ]);
            }
        });
        User::all()->each(function ($user) {
            $follows = User::where('id', '!=', $user->id)->inRandomOrder()->take(rand(1, 3))->get();
            foreach ($follows as $follow) {
                $user->follow($follow->id);
            }
        });
    }
}
