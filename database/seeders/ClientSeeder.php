<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds
     * @return void
     */
    public function run(): void
    {
        Client::query()->create([
            'name'                  => 'John Doe',
            'email'                 => 'johndoe@gmail.com',
            'email_verified_at'     => now(),
            'mobile'                => '880 1945-478512',
            'mobile_verified_at'    => now(),
            'password'              => Hash::make('pass?word'),
            'remember_token'        => Str::random(10),
        ]);
    }
}
