<?php

namespace Database\Seeders;

use App\Models\Skeleton;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SkeletonSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds
     * @return void
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function run(): void
    {
        $source = jsonFileExtractor(base_path('database/schema/skeletons.json'), null, false);
        foreach ($source as $each) {
            $skeleton = Skeleton::query()->create(['slug' => Str::of($each->en)->slug()->toString()]);
            foreach ($each as $local => $title) {
                $skeleton->translate()->create(['title' => $title, 'local' => $local]);
            }
        }
    }
}
