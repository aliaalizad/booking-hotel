<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class ManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->numerify('manager-####'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_blocked' => $this->faker->randomElement([0, 1]),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->email(),
            'city_id' => 1,
            'bank_account' => '111111111111111111111111',
            'commission' => 5,
        ];
    }
}
