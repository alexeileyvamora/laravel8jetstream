<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Browser;

class BrowserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            array('nombre' =>'Chrome', 'porcentaje' => 61.4),
            array('nombre' =>'IE explorer', 'porcentaje' => 11.8),
            array('nombre' =>'Firefox', 'porcentaje' => 10.9),
            array('nombre' =>'Edge', 'porcentaje' => 4.7),
            array('nombre' =>'Safari', 'porcentaje' => 4.2),
            array('nombre' =>'Opera', 'porcentaje' => 1.6),

        ];
        Browser::insert($data);
    }
}
