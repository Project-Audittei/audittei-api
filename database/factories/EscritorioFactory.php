<?php

namespace Database\Factories;

use App\Models\Escritorio;
use Faker\Provider\pt_BR\Company;
use Faker\Provider\pt_BR\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Filesystem\AwsS3V3Adapter;

use function App\Helpers\GerarCNPJ;
use function App\Helpers\GerarGUID;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Escritorio>
 */
class EscritorioFactory extends Factory
{
    protected $model = Escritorio::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new PhoneNumber($this->faker));

        return [
            'guid' => GerarGUID(),
            'cnpj' => GerarCNPJ(),
            'razaoSocial' => fake()->name(),
            'telefone' => fake()->landlineNumber(false),
            'email' => fake()->email(),
            'cep' => '22071020',
            'logradouro' => fake()->streetAddress(),
            'bairro' => fake()->name(),
            'cidade' => fake()->city(),
            'uf' => "RJ"
        ];
    }
}
