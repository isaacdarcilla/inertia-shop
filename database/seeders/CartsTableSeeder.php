<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('carts')->delete();
        
        \DB::table('carts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 2,
                'price' => '49',
                'checkout_at' => '2022-08-16 06:06:06',
                'created_at' => '2022-08-16 06:05:55',
                'updated_at' => '2022-08-16 06:06:06',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}