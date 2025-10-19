<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Deploy esnasında oluşturulacak kullanıcılar

        User::create([
            'name' => 'Doğan TATAR',
            'email' => 'dogantatarjr@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Aydan COMBA',
            'email' => 'aydancemrecomba@gmail.com',
            'password'=> bcrypt('12345678'),
            'role' => 'writer',
        ]);

        User::create([
            'name' => 'Kuzey GÖKTEPE',
            'email' => 'kuzey.goktepe@gmail.com',
            'password'=> bcrypt('12345678'),
            'role' => 'user',
        ]);
    }
}
