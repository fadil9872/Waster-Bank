<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SaldoSeeder::class);
        $this->call(SampahSeeder::class);
        // $this->call(Seeder::class);
        // $this->call(Seeder::class);
    }
}
