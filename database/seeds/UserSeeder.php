<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert ([
            [
                'name'      =>  'Admin',
                'email'     =>  'admin@gmail.com',
                'password'  =>  bcrypt('admin123'),
                'role'      =>  '5',
                'alamat'    =>  'Pondok IT',
                'no_telpon' =>  '085223566615',
                'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',
            ],
            [
                'name'      =>  'Bendahara',
                'email'     =>  'bendahara@gmail.com',
                'password'  =>  bcrypt('admin123'),
                'role'      =>  '4',
                'alamat'    =>  'Pondok IT',
                'no_telpon' =>  '085223566615',
                'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',
            ],
            [
                'name'      =>  'Pengurus 2',
                'email'     =>  'pengurus2@gmail.com',
                'password'  =>  bcrypt('admin123'),
                'role'      =>  '3',
                'alamat'    =>  'Pondok IT',
                'no_telpon' =>  '085223566615',
                'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',
            ],
            [
                'name'      =>  'Pengurus 1',
                'email'     =>  'pengurus1@gmail.com',
                'password'  =>  bcrypt('admin123'),
                'role'      =>  '2',
                'alamat'    =>  'Pondok IT',
                'no_telpon' =>  '085223566615',
                'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',
            ],
            [
                'name'      =>  'Adian281r',
                'email'     =>  'adian281r@gmail.com',
                'password'  =>  bcrypt('admin123'),
                'role'      =>  '1',
                'alamat'    =>  'Pondok IT',
                'no_telpon' =>  '085223566615',
                'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',
            ],
        ]);
    }
}
