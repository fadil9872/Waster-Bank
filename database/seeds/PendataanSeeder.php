<?php

use Illuminate\Database\Seeder;

class PendataanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("INSERT INTO permintaans (id, user_id, pengurus_id, alamat_id, nama, lokasi, wilayah_id, no_telpon, keterangan, status, tanggal, created_at, updated_at) VALUES 
        (1, '7', NULL, '7', 'nasabah', 'Tirtohargo, Kretek', '3402030', '08522356616', 'datang', '1', '2021-01-14', '2021-01-14 19:14:52', '2021-01-14 19:14:52'),
        (2, '7', NULL, '7', 'nasabah', 'Tirtohargo, Kretek', '3402030', '08522356616', 'datang', '1', '2021-01-14', '2021-01-14 19:14:52', '2021-01-14 19:14:52');
         ");
    }

   
}
