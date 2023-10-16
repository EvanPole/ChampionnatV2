<?php

namespace Database\Seeders;

use App\Models\Matche;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatcheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Matche::factory(40)->create();
    }
}
