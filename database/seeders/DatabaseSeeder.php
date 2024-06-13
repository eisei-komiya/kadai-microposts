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
                Micropost::factory(20)->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id
                ]);
            }
        });
        //ユーザー一人一人に対して、
        User::all()->each(function ($user) {
            //自分以外のユーザーからランダムに4ユーザー取得
            $follows = User::where('id', '!=', $user->id)->inRandomOrder()->take(5)->get();
            foreach ($follows as $follow) {
                //フォロー
                $user->follow($follow->id);
            }
            //ランダムに4ポスト取得
            $posts = Micropost::inRandomOrder()->take(20)->get();
            foreach ($posts as $post) {
                //お気に入り登録
                $user->favorite($post->id);
            }
        });
    }
}
