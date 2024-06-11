<?php

namespace Database\Factories;

use App\Models\Micropost;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Micropost>
 */
class MicropostFactory extends Factory
{
    protected $model = Micropost::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $category = Category::where('user_id', $user->id)->inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'content' => $this->faker->realText(10, 5),
            'created_at' => $this->faker->dateTimeThisDecade(), // 過去10年のランダムなdatetime
            'updated_at' => now(),
        ];
    }
}