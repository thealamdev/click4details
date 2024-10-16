<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds
     * @return void
     */
    public function run(): void
    {
        $values = jsonFileExtractor(base_path('database/schema/users.json'), fn ($data) => collect($data)->map(fn ($each) => [
            'name'              => $each->name,
            'email'             => $each->email,
            'email_verified_at' => now(),
            'password'          => Hash::make($each->password),
            'role'              => $each->role,
            'remember_token'    => Str::random(10),
            'created_at'        => now()->toDateTime(),
            'updated_at'        => now()->toDateTime(),
        ])->toArray(), false);
        User::query()->insert($values);
    }
}
