<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name'          =>  'admin',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'bendahara',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'pengurus1',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'pengurus2',
                'guard_name'    =>  'web',
            ],
            [
                'name'          =>  'nasabah',
                'guard_name'    =>  'web',
            ],
        ]);
    }
}
