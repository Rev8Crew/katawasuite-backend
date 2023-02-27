<?php

namespace Modules\User\Database\factories;

use App\Enums\ActiveStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Modules\User\Entities\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt($this->faker->password()),
            'is_active' => ActiveStatusEnum::Active->value,
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function inactive(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => ActiveStatusEnum::Inactive->value,
            ];
        });
    }
}
