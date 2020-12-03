<?php

namespace Database\Seeders;

use App\Models\Serie;
use Illuminate\Database\Seeder;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Serie::create([
            'nombre' => 'Breakin Bad',
            'api_id' => '111',
            'user_id' => '1',
        ]);
        Serie::create([
            'nombre' => 'Peaky Blinders',
            'api_id' => '222',
            'user_id' => '1',
        ]);
        Serie::create([
            'nombre' => 'Sex Education',
            'api_id' => '111',
            'user_id' => '2',
        ]);


    }
}
