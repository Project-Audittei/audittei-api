<?php

namespace Database\Factories;

use App\Faker\Providers\TelefoneBrasileiroProvider;
use App\Models\User;
use Faker\Provider\pt_BR\Person;
use Faker\Provider\pt_BR\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function App\Helpers\GerarGUID;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new PhoneNumber($this->faker));
        fake()->addProvider(new Person($this->faker));
        
        return [
            'guid' => GerarGUID(),
            'nomeCompleto' => fake()->name() . " " . fake()->lastName(),
            'email' => fake()->unique()->email(),
            'senha' => 'Audittei2024!',
            'telefone' => fake()->landlineNumber(false),
            'email_verified_at' => now()
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
