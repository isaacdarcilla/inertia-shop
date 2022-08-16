<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category_id' => 1,
                'name' => 'Milktea',
                'description' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum',
                'slug' => 'milktea-3252',
                'price' => '50',
                'created_at' => '2022-08-13 13:20:04',
                'updated_at' => '2022-08-13 13:20:04',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'category_id' => 1,
                'name' => 'Iced Tea',
                'description' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document.',
                'slug' => 'iced-tea-3252',
                'price' => '49',
                'created_at' => '2022-08-13 13:20:04',
                'updated_at' => '2022-08-13 13:20:04',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}