<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GradeSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds
     * @return void
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function run(): void
    {
        $source = jsonFileExtractor(base_path('database/schema/grades.json'), null, false);
        foreach ($source as $each) {
            $edition = Grade::query()->create(['slug' => Str::of($each->en)->slug()->toString()]);
            foreach ($each as $local => $title) {
                $edition->translate()->create(['title' => $title, 'local' => $local]);
            }
        }
    }
}
