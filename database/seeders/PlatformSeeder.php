<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run()
    {
        Platform::create(['name' => 'Twitter', 'type' => 'twitter']);
        Platform::create(['name' => 'Facebook', 'type' => 'facebook']);
        Platform::create(['name' => 'Instagram', 'type' => 'instagram']);
        Platform::create(['name' => 'LinkedIn', 'type' => 'linkedin']);
    }
}
