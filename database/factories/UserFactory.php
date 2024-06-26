<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    
    /**
     * Configure the factory to increment name as test1, test2, etc.
     */
    public function configure()
    {
        return $this->afterMaking(function (User $user) {
            static $number = 0;
            $user->name = 'test' . $number;
            $user->email = $user->name . "@test.com";
            $user->password = Hash::make('password' . $number);
            if($number===0){
                $user->name = "Komiya";
                $user->email = "eisei-komiya@dac.co.jp";
                $user->password = Hash::make('password');
            }
            $number++;
        });
    }
}
