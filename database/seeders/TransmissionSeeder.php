<?php

namespace Database\Seeders;

use App\Models\Transmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TransmissionSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds
     * @return void
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function run(): void
    {
        $source = jsonFileExtractor(base_path('database/schema/transmissions.json'), null, false);
        foreach ($source as $each) {
            $transmission = Transmission::query()->create(['slug' => Str::of($each->en)->slug()->toString()]);
            foreach ($each as $local => $title) {
                $transmission->translate()->create(['title' => $title, 'local' => $local]);
            }
        }
    }
}
