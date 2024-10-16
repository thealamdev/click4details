<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ClientSeeder::class,
            CategorySeeder::class,
            MerchantSeeder::class,
            BrandSeeder::class,
            ConditionSeeder::class,
            EditionSeeder::class,
            EngineSeeder::class,
            FuelSeeder::class,
            GradeSeeder::class,
            MileageSeeder::class,
            SkeletonSeeder::class,
            TransmissionSeeder::class
        ]);
    }
}
