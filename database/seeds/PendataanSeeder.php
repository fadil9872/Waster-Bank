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
        DB::insert("INSERT INTO permintaans (id, user_id, pengurus_id, nama, lokasi, no_telpon, keterangan, status, created_at, updated_at) VALUES
        (1, 5, NULL, 'Adian281r', 'CIrebon', '08522356616', 'datang', '1', '2020-12-30 00:06:58', '2021-01-05 18:58:03'),
        (2, 5, NULL, 'Adian281r', 'CIrebon', '08522356616', 'dijemput', '1', '2020-12-30 00:06:58', '2021-01-05 18:58:03');");
    }
}
