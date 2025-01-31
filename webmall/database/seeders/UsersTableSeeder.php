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
                'role_id' => 2,
                'name' => 'Momo Seck',
                'email' => 'momo@me.com',
                'phone' => '',
                'verified' => NULL,
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$12$5RjFtEvv8NoH1tR8t6/zUOFXS6UM4.kQOKOQ.0SOrtIQIMfOMQkSO',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2023-12-07 02:09:04',
                'updated_at' => '2023-12-07 02:22:33',
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 1,
                'name' => 'Mo Seck',
                'email' => 'admin@webmall.net',
                'phone' => '',
                'verified' => NULL,
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$12$rOHFlEJ/iMSIO3uBXvqz7udsNmgTi5o72S06FjGLbNRUYsA6p9Oeu',
                'remember_token' => 'RYSq9LMZnQF6hyjzrOPnLJanco0nyHCvmnE85qcIlB8upUdAhv4pZQPm16Ux',
                'settings' => '{"locale":"en"}',
                'created_at' => '2023-12-07 02:04:58',
                'updated_at' => '2024-02-23 04:25:27',
            ),
            2 => 
            array (
                'id' => 3,
                'role_id' => 3,
                'name' => 'Mouha Seck',
                'email' => 'mopointofsales@gmail.com',
                'phone' => '',
                'verified' => NULL,
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$12$Q5qCAqRJdYFz7Csdp78COO/tefpMlv0rz7iSj93Xf61Hxgo9Fh/QS',
                'remember_token' => 'sitPU2nsVtgFZz3zO5lVLMBZWA80FdzJg7EbOVMzzQlAmNLQnxfyURh8CP2o',
                'settings' => '{"locale":"en"}',
                'created_at' => '2023-12-07 02:09:04',
                'updated_at' => '2024-05-07 17:48:13',
            ),
            3 => 
            array (
                'id' => 4,
                'role_id' => 3,
                'name' => 'badou Seck',
                'email' => 'badou@me.com',
                'phone' => '',
                'verified' => NULL,
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$12$ffu5Kyk7zGdPEQmVYxxDduHZFP9o63M.dVUJVeUA2JvWZMNLDbr3C',
                'remember_token' => '91PRonFCNGefJ9hVXfy3Lw793q07OreeooSamu4tYEN54SfI02IHRCL39Qfr',
                'settings' => NULL,
                'created_at' => '2023-12-07 02:09:04',
                'updated_at' => '2023-12-07 02:22:33',
            ),
            4 => 
            array (
                'id' => 5,
                'role_id' => NULL,
                'name' => 'mouhamadou seck',
                'email' => 'seckaa@gmail.com',
                'phone' => '',
                'verified' => NULL,
                'avatar' => NULL,
                'email_verified_at' => NULL,
                'password' => '$2y$12$zVsWEBFvoof6qOATbL3jneSeN2oVGd2PIC5OKTzUCuB2eV1Knc0MG',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 10,
                'role_id' => 2,
                'name' => 'Cheikh Cisse',
                'email' => 'cheikh@me.net',
                'phone' => '2122346474',
                'verified' => NULL,
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$12$PLawMEzx5ReKw3EPlNGK8u1ysbalrBcWSYnbyKMK2TJCLO3.oajs6',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2024-05-18 18:59:09',
                'updated_at' => '2024-05-18 18:59:09',
            ),
        ));
        
        
    }
}