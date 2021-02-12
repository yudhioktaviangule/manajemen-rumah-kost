<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aset;
class AsetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aset::factory(1000)->create();
    }
}
