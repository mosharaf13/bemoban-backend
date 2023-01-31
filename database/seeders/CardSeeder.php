<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::factory()
            ->count(12)
            ->for(Column::factory())
            ->create();
    }
}
