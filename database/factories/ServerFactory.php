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
        $wipeDate = $this->faker->dateTimeThisMonth();

        return [
            'user_id' => User::factory(),
            'api_key' => $this->faker->uuid(),
            'slug' => $this->faker->slug(),
            'name' => $this->faker->company(),
            'ip_address' => $this->faker->ipv4(),
            'port' => $this->faker->randomNumber(4, true),
            'world_seed' => $this->faker->randomNumber(8),
            'world_name' => "Procedural Map",
            'map_size' => $this->faker->randomFloat(2,1, 6),
            'protocol' => $this->faker->semver(),
            'last_wiped' => $wipeDate,
            'blueprint_last_wiped' => $wipeDate,
            'description' => $this->faker->paragraph(),
            'refresh_rate' => 60.0,
            'tags' => "monthly,pve,vanilla"
        ];
    }
}
