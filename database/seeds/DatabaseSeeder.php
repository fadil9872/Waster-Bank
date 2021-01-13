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
        // $this->call(RoleSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(WilayahSeeder::class);
        $this->call(AlamatSeeder::class);
        $this->call(SaldoSeeder::class);
        $this->call(SampahSeeder::class);
        $this->call(PendataanSeeder::class);
        $this->call(GudangSeeder::class);
    }
}
