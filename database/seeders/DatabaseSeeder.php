<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use function App\Helpers\GerarGUID;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'guid' => GerarGUID(),
            'nomeCompleto' => "Fernando Ávila",
            'email' => "fernandoavilajunior@gmail.com",
            'senha' => Hash::make('Audittei2024!'),
            'telefone' => "21989407820"
        ]);
    }
}
