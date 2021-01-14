<?php

use Illuminate\Database\Seeder;

class SaldoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('saldos')->insert([
            [
                'user_id'   =>  7,
                'saldo'     =>  0,  
            ]
        ]);
    }
}
