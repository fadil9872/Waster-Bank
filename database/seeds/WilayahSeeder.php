<?php

use App\Model\Wilayah;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wilayahs')->insert([
            [
                'id'        => 3402010,
                'id_kota'   => '3402',
                'nama'      => 'Srandakan'
            ],
            [
                'id'        => 3402020,
                'id_kota'   => '3402',
                'nama'      => 'Sanden'
            ],
            [
                'id'        => 3402030,
                'id_kota'   => '3402',
                'nama'      => 'Kretek'
            ],
            [
                'id'        => 3402040,
                'id_kota'   => '3402',
                'nama'      => 'Pundong'
            ],
            [
                'id'        => 3402050,
                'id_kota'   => '3402',
                'nama'      => 'Bambang Lipuro'
            ],
            [
                'id'        => 3402060,
                'id_kota'   => '3402',
                'nama'      => 'Pandak'
            ],
            [
                'id'        => 3402070,
                'id_kota'   => '3402',
                'nama'      => 'Bantul'
            ],
            [
                'id'        => 3402080,
                'id_kota'   => '3402',
                'nama'      => 'Jetis'
            ],
            [
                'id'        => 3402090,
                'id_kota'   => '3402',
                'nama'      => 'Imogiri'
            ],
            [
                'id'        => 3402100,
                'id_kota'   => '3402',
                'nama'      => 'Dlingo'
            ],
            [
                'id'        => 3402110,
                'id_kota'   => '3402',
                'nama'      => 'Pleret'
            ],
            [
                'id'        => 3402120,
                'id_kota'   => '3402',
                'nama'      => 'Piyungan'
            ],
            [
                'id'        => 3402130,
                'id_kota'   => '3402',
                'nama'      => 'Banguntapan'
            ],
            [
                'id'        => 3402140,
                'id_kota'   => '3402',
                'nama'      => 'Sewon'
            ],
            [
                'id'        => 3402150,
                'id_kota'   => '3402',
                'nama'      => 'Kasihan'
            ],
            [
                'id'        => 3402160,
                'id_kota'   => '3402',
                'nama'      => 'Pajangan'
            ],
            [
                'id'        => 3402170,
                'id_kota'   => '3402',
                'nama'      => 'Sedayu'
            ]
        ]);
    }
}
