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
                'sampah_id' =>  2,
                'berat'     =>  10000000,
            ],
            [
                'sampah_id' =>  7,
                'berat'     =>  0,
            ],
        ]);
    }
}
