<?php

namespace Database\Factories;

use App\Models\Auth\User;
use App\Models\Server;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Server>
 */
class ServerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Server::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'api_key' => $this->faker->uuid(),
            'name' => $this->faker->company(),
            'ip_address' => $this->faker->ipv4(),
            'port' => $this->faker->randomNumber(4, true),
            'description' => $this->faker->paragraph()
        ];
    }
}
