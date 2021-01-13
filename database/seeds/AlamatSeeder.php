<?php

use App\Model\Alamat;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alamats')->insert([
            [
                'user_id'   => 1,
                'wilayah_id'=> 	3402030,
                'alamat'    => 'Tirtohargo, kretek',
                'status'    => 1,
            ],
            [
                'user_id'   => 2,
                'wilayah_id'=> 	3402030,
                'alamat'    => 'Tirtohargo, kretek',
                'status'    => 1,
            ],
            [
                'user_id'   => 3,
                'wilayah_id'=> 	3402030,
                'alamat'    => 'Tirtohargo, kretek',
                'status'    => 1,
            ],
            [
                'user_id'   => 4,
                'wilayah_id'=> 	3402030,
                'alamat'    => 'Tirtohargo, kretek',
                'status'    => 1,
            ],
            [
                'user_id'   => 5,
                'wilayah_id'=> 	3402030,
                'alamat'    => 'Tirtohargo, kretek',
                'status'    => 1,
            ],
        ]);
    }
}
