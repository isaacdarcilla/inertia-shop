<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Food & Beverages',
                'created_at' => '2022-08-13 13:19:32',
                'updated_at' => '2022-08-13 13:19:32',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'IT Equipments',
                'created_at' => '2022-08-13 13:19:32',
                'updated_at' => '2022-08-13 13:19:32',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}