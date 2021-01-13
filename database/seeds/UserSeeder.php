<?php

use App\Model\Saldo;
use Illuminate\Database\Seeder;
use App\Model\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([

            'name'      =>  'Admin',
            'email'     =>  'admin@gmail.com',
            'password'  =>  bcrypt('admin123'),
            // 'alamat'    =>  'Pondok IT',
            'no_telpon' =>  '085223566615',
            'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',

        ]);
        $admin->assignRole('admin');

        $bendahara = User::create([

            'name'      =>  'Bendahara',
            'email'     =>  'bendahara@gmail.com',
            'password'  =>  bcrypt('admin123'),
            // 'alamat'    =>  'Pondok IT',
            'no_telpon' =>  '085223566615',
            'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',

        ]);
        $bendahara->assignRole('bendahara');

        $cs1 = User::create([

            'name'      =>  'Costmer Service Kretek',
            'email'     =>  'cs_kretek@gmail.com',
            'password'  =>  bcrypt('admin123'),
            // 'alamat'    =>  'Pondok IT',
            'no_telpon' =>  '085223566615',
            'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',

        ]);
        $cs1->assignRole('costumer_service');
        
        $cs2 = User::create([

            'name'      =>  'Costmer Service Parangtritis',
            'email'     =>  'cs_parangtritis@gmail.com',
            'password'  =>  bcrypt('admin123'),
            // 'alamat'    =>  'Pondok IT',
            'no_telpon' =>  '085223566615',
            'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',

        ]);
        $cs2->assignRole('costumer_service');

        $pengurus1 = User::create([

            'name'      =>  'Pengurus 1',
            'email'     =>  'pengurus1@gmail.com',
            'password'  =>  bcrypt('admin123'),
            // 'alamat'    =>  'Pondok IT',
            'no_telpon' =>  '085223566615',
            'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',

        ]);
        $pengurus1->assignRole('pengurus1');

        $pengurus2 = User::create([

            'name'      =>  'Pengurus 2',
            'email'     =>  'pengurus2@gmail.com',
            'password'  =>  bcrypt('admin123'),
            // 'alamat'    =>  'Pondok IT',
            'no_telpon' =>  '085223566615',
            'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',

        ]);
        $pengurus2->assignRole('pengurus2');

        $nasabah = User::create([

            'name'      =>  'Adian281r',
            'email'     =>  'adian281r@gmail.com',
            'password'  =>  bcrypt('admin123'),
            // 'alamat'    =>  'Pondok IT',
            'no_telpon' =>  '085223566615',
            'avatar'    =>  'https:\/\/iili.io\/FVdLas.png',

        ]);
        $nasabah->assignRole('nasabah');
    }
}
