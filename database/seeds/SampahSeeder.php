<?php

use Illuminate\Database\Seeder;

class SampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::$table('sampahs')->insert([
            [
                'nama'  =>  'Plastik',
                'harga' =>  '3000',
            ],
            [
                'nama'  =>  'Besi',
                'harga' =>  '7000',
            ],
            [
                'nama'  =>  'Kaleng',
                'harga' =>  '4000',
            ],
            [
                'nama'  =>  'Kertas',
                'harga' =>  '6000',
            ],
        ]);
    }
}
