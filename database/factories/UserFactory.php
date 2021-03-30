<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genders = ['MALE', 'FEMALE'];
        $current_gender = $genders[rand(0, 1)];
        $number_range = ($current_gender === 'MALE') ? [120000000, 129999999] : [220000000, 229999999];
        $id_number = random_int($number_range[0], $number_range[1]);

        return [
            'serial_number' => Str::random(9),
            'name' => $this->faker->name,
            'gender' => $current_gender,
            'id_number' => 'A' . $id_number,
            'birthday' => $this->faker->date,
            'address' => $this->faker->address,
            'username' => $this->faker->userName,
            'password' => Hash::make('123456'),
            'phone' => $this->faker->phoneNumber,
            'report_date' => today()
        ];
    }
}
