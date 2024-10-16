<?php

namespace Database\Seeders;

use App\Models\Fuel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FuelSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds
     * @return void
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function run(): void
    {
        $source = jsonFileExtractor(base_path('database/schema/fuels.json'), null, false);
        foreach ($source as $each) {
            $fuel = Fuel::query()->create(['slug' => Str::of($each->en)->slug()->toString()]);
            foreach ($each as $local => $title) {
                $fuel->translate()->create(['title' => $title, 'local' => $local]);
            }
        }
    }
}
