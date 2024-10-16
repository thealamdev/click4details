<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MerchantSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds
     * @return void
     */
    public function run(): void
    {
        $source = jsonFileExtractor(base_path('database/schema/merchants.json'), null, false);
        foreach ($source as $each) {
            Merchant::query()->create(array_merge_recursive(['email_verified_at' => now(), 'mobile_verified_at'  => now()], [
                'name'      => $each->name,
                'email'     => $each->email,
                'mobile'    => $each->mobile,
                'password'  => Hash::make($each->password),
            ]));
        }
    }
}
