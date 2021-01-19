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
                'user_id'   =>  1,
                'saldo'     =>  0,  
            ],
            [
                'user_id'   =>  2,
                'saldo'     =>  0,  
            ],
            [
                'user_id'   =>  3,
                'saldo'     =>  0,  
            ],
            [
                'user_id'   =>  4,
                'saldo'     =>  0,  
            ],
            [
                'user_id'   =>  5,
                'saldo'     =>  0,  
            ],
        ]);
    }
}
