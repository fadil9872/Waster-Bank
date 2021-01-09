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
        DB::table('sampahs')->insert([
            [
                'nama'  =>  'Plastik',
                'harga_nasabah' =>  '3000',
                'harga_pengepul'    => '3300',
            ],
            [
                'nama'  =>  'Besi',
                'harga_nasabah' =>  '7000',
                'harga_pengepul'    =>  '7700',
            ],
            [
                'nama'  =>  'Kaleng',
                'harga_nasabah' =>  '4000',
                'harga_pengepul'    =>  '4400',
            ],
            [
                'nama'  =>  'Kertas',
                'harga_nasabah' =>  '6000',
                'harga_pengepul'    =>  '6600',
            ],
        ]);
    }
}
