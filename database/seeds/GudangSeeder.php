<?php

use Illuminate\Database\Seeder;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gudangs')->insert([
            [
                'sampah_id' =>  1,
                'berat'     =>  0,
            ],
            [
                'sampah_id' =>  2,
                'berat'     =>  0,
            ],
            [
                'sampah_id' =>  3,
                'berat'     =>  0,
            ],
            [
                'sampah_id' =>  4,
                'berat'     =>  0,
            ],
        ]);
    }
}
