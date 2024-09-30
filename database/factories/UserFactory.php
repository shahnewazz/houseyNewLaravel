<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' =>  sanitize_username($this->faker->unique()->userName),
            'email' => $this->faker->unique()->safeEmail,
            'user_type' => $this->faker->randomElement(['normal', 'admin']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password hashing
            'remember_token' => \Str::random(10),
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
}