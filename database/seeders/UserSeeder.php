<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'username' => 'root',
            'password' => Hash::make('1234'),
            'nome' => 'Administrador',
            'email' => 'admin@exemplo.com',
            'cpf' => '12345678901',
            'ativo' => 't',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
