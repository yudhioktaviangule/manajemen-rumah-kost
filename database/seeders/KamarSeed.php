<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;
class KamarSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kamar::factory(500)->create();
    }
}
