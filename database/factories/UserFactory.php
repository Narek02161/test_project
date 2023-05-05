<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'email' => $this->faker->email,
            'ip' => $this->faker->localIpv4(),
            'display_name' => $this->faker->name,
            'language' => $this->faker->languageCode,
            'telegram_username' => '@'.$this->faker->name,
            'password' => bcrypt($this->faker->randomNumber(6, 9)),
        ];
    }
}
