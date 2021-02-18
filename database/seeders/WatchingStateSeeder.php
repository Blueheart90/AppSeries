<?php

namespace Database\Seeders;

use App\Models\WatchingState;
use Illuminate\Database\Seeder;

class WatchingStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WatchingState::create([
            'id' => 1,
            'name' => 'Viendo',
        ]);
        WatchingState::create([
            'id' => 2,
            'name' => 'Completa',
        ]);
        WatchingState::create([
            'id' => 3,
            'name' => 'En Espera',
        ]);
        WatchingState::create([
            'id' => 4,
            'name' => 'Abandonada',
        ]);
        WatchingState::create([
            'id' => 5,
            'name' => 'En Plan Para Ver',
        ]);
    }
}
