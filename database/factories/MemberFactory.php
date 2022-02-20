<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $manager = Manager::find(rand(1, count(Manager::all())));
        $hotel = Hotel::where('manager_id', $manager->id)->get()->random();

        return [
            'name' => $this->faker->name(),
            'personnel_code' => $this->faker->unique()->randomNumber(8, true),
            'phone' => $this->faker->unique()->e164PhoneNumber(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_blocked' => $this->faker->randomElement([0, 1]),
            'manager_id' => $manager->id,
            'hotel_id' => $this->faker->randomElement([$hotel->id, null]),
        ];
    }
}
