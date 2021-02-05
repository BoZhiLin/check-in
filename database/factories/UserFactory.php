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
        $genders = ['MALE', 'FEMALE', 'OTHER'];

        return [
            'name' => $this->faker->name,
            'username' => $this->faker->userName,
            'password' => Hash::make('123456'),
            'gender' => $genders[rand(0, 2)],
            'phone' => $this->faker->phoneNumber,
            'report_date' => today(),
            'remark' => 'test-user'
        ];
    }
}
