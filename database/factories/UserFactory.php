<?php

namespace Database\Factories;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $username = $this->faker->userName();

        return [
            'provider' => 'discord',
            'provider_id' => $this->faker->randomNumber(9, true) . $this->faker->randomNumber(9, true),
            'username' => $username,
            'discriminator' => 0,
            'fullusername' => $username,
            'avatar' => 'https://placehold.co/128',
            'email' => $this->faker->email(),
            'email_verified' => $this->faker->boolean(),
            'locale' => $this->faker->locale(),
            'twofactor' => $this->faker->boolean(),
            'admin' => 0,
            'tos_accept' => 1,
            'tos_accept_date' => $this->faker->dateTimeThisMonth(),
            'privacy_accept' => 1,
            'privacy_accept_date' => $this->faker->dateTimeThisMonth(),
            'news_notifications' => $this->faker->boolean(),
            'remember_token' => NULL
        ];
    }
}
