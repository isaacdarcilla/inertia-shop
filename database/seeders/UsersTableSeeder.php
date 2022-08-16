<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Isaac Arcilla',
                'email' => 'isaac@gmail.com',
                'address' => 'Bicol Region',
                'email_verified_at' => '2022-08-16 13:40:04',
                'password' => '$2a$12$7Rv6DSKgsIRpm87BQPsrSurwVX1yJG0neqmaBoiqUsv5IZ5nYlIBK',
                'remember_token' => NULL,
                'created_at' => '2022-08-16 13:40:04',
                'updated_at' => '2022-08-16 13:40:04',
            ),
        ));
        
        
    }
}