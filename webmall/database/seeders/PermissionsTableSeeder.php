<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'browse_admin',
                'table_name' => NULL,
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'browse_bread',
                'table_name' => NULL,
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'browse_database',
                'table_name' => NULL,
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'browse_media',
                'table_name' => NULL,
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'browse_compass',
                'table_name' => NULL,
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'browse_menus',
                'table_name' => 'menus',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'read_menus',
                'table_name' => 'menus',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'edit_menus',
                'table_name' => 'menus',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'add_menus',
                'table_name' => 'menus',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'delete_menus',
                'table_name' => 'menus',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'browse_roles',
                'table_name' => 'roles',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'read_roles',
                'table_name' => 'roles',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'edit_roles',
                'table_name' => 'roles',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'add_roles',
                'table_name' => 'roles',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'delete_roles',
                'table_name' => 'roles',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'browse_users',
                'table_name' => 'users',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'read_users',
                'table_name' => 'users',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'edit_users',
                'table_name' => 'users',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'add_users',
                'table_name' => 'users',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'delete_users',
                'table_name' => 'users',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'browse_settings',
                'table_name' => 'settings',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'read_settings',
                'table_name' => 'settings',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'edit_settings',
                'table_name' => 'settings',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'add_settings',
                'table_name' => 'settings',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'delete_settings',
                'table_name' => 'settings',
                'created_at' => '2023-12-06 17:28:28',
                'updated_at' => '2023-12-06 17:28:28',
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'browse_categories',
                'table_name' => 'categories',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'read_categories',
                'table_name' => 'categories',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'edit_categories',
                'table_name' => 'categories',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'add_categories',
                'table_name' => 'categories',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'delete_categories',
                'table_name' => 'categories',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'browse_posts',
                'table_name' => 'posts',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            31 => 
            array (
                'id' => 32,
                'key' => 'read_posts',
                'table_name' => 'posts',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            32 => 
            array (
                'id' => 33,
                'key' => 'edit_posts',
                'table_name' => 'posts',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            33 => 
            array (
                'id' => 34,
                'key' => 'add_posts',
                'table_name' => 'posts',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            34 => 
            array (
                'id' => 35,
                'key' => 'delete_posts',
                'table_name' => 'posts',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            35 => 
            array (
                'id' => 36,
                'key' => 'browse_pages',
                'table_name' => 'pages',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            36 => 
            array (
                'id' => 37,
                'key' => 'read_pages',
                'table_name' => 'pages',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            37 => 
            array (
                'id' => 38,
                'key' => 'edit_pages',
                'table_name' => 'pages',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            38 => 
            array (
                'id' => 39,
                'key' => 'add_pages',
                'table_name' => 'pages',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            39 => 
            array (
                'id' => 40,
                'key' => 'delete_pages',
                'table_name' => 'pages',
                'created_at' => '2023-12-06 17:28:29',
                'updated_at' => '2023-12-06 17:28:29',
            ),
            40 => 
            array (
                'id' => 41,
                'key' => 'browse_orders',
                'table_name' => 'orders',
                'created_at' => '2023-12-06 17:35:37',
                'updated_at' => '2023-12-06 17:35:37',
            ),
            41 => 
            array (
                'id' => 42,
                'key' => 'read_orders',
                'table_name' => 'orders',
                'created_at' => '2023-12-06 17:35:37',
                'updated_at' => '2023-12-06 17:35:37',
            ),
            42 => 
            array (
                'id' => 43,
                'key' => 'edit_orders',
                'table_name' => 'orders',
                'created_at' => '2023-12-06 17:35:37',
                'updated_at' => '2023-12-06 17:35:37',
            ),
            43 => 
            array (
                'id' => 44,
                'key' => 'add_orders',
                'table_name' => 'orders',
                'created_at' => '2023-12-06 17:35:37',
                'updated_at' => '2023-12-06 17:35:37',
            ),
            44 => 
            array (
                'id' => 45,
                'key' => 'delete_orders',
                'table_name' => 'orders',
                'created_at' => '2023-12-06 17:35:37',
                'updated_at' => '2023-12-06 17:35:37',
            ),
            45 => 
            array (
                'id' => 46,
                'key' => 'browse_shops',
                'table_name' => 'shops',
                'created_at' => '2023-12-06 18:53:16',
                'updated_at' => '2023-12-06 18:53:16',
            ),
            46 => 
            array (
                'id' => 47,
                'key' => 'read_shops',
                'table_name' => 'shops',
                'created_at' => '2023-12-06 18:53:16',
                'updated_at' => '2023-12-06 18:53:16',
            ),
            47 => 
            array (
                'id' => 48,
                'key' => 'edit_shops',
                'table_name' => 'shops',
                'created_at' => '2023-12-06 18:53:16',
                'updated_at' => '2023-12-06 18:53:16',
            ),
            48 => 
            array (
                'id' => 49,
                'key' => 'add_shops',
                'table_name' => 'shops',
                'created_at' => '2023-12-06 18:53:16',
                'updated_at' => '2023-12-06 18:53:16',
            ),
            49 => 
            array (
                'id' => 50,
                'key' => 'delete_shops',
                'table_name' => 'shops',
                'created_at' => '2023-12-06 18:53:16',
                'updated_at' => '2023-12-06 18:53:16',
            ),
            50 => 
            array (
                'id' => 51,
                'key' => 'browse_products',
                'table_name' => 'products',
                'created_at' => '2023-12-07 02:25:41',
                'updated_at' => '2023-12-07 02:25:41',
            ),
            51 => 
            array (
                'id' => 52,
                'key' => 'read_products',
                'table_name' => 'products',
                'created_at' => '2023-12-07 02:25:41',
                'updated_at' => '2023-12-07 02:25:41',
            ),
            52 => 
            array (
                'id' => 53,
                'key' => 'edit_products',
                'table_name' => 'products',
                'created_at' => '2023-12-07 02:25:41',
                'updated_at' => '2023-12-07 02:25:41',
            ),
            53 => 
            array (
                'id' => 54,
                'key' => 'add_products',
                'table_name' => 'products',
                'created_at' => '2023-12-07 02:25:41',
                'updated_at' => '2023-12-07 02:25:41',
            ),
            54 => 
            array (
                'id' => 55,
                'key' => 'delete_products',
                'table_name' => 'products',
                'created_at' => '2023-12-07 02:25:41',
                'updated_at' => '2023-12-07 02:25:41',
            ),
            55 => 
            array (
                'id' => 56,
                'key' => 'browse_coupons',
                'table_name' => 'coupons',
                'created_at' => '2023-12-13 23:36:35',
                'updated_at' => '2023-12-13 23:36:35',
            ),
            56 => 
            array (
                'id' => 57,
                'key' => 'read_coupons',
                'table_name' => 'coupons',
                'created_at' => '2023-12-13 23:36:35',
                'updated_at' => '2023-12-13 23:36:35',
            ),
            57 => 
            array (
                'id' => 58,
                'key' => 'edit_coupons',
                'table_name' => 'coupons',
                'created_at' => '2023-12-13 23:36:35',
                'updated_at' => '2023-12-13 23:36:35',
            ),
            58 => 
            array (
                'id' => 59,
                'key' => 'add_coupons',
                'table_name' => 'coupons',
                'created_at' => '2023-12-13 23:36:35',
                'updated_at' => '2023-12-13 23:36:35',
            ),
            59 => 
            array (
                'id' => 60,
                'key' => 'delete_coupons',
                'table_name' => 'coupons',
                'created_at' => '2023-12-13 23:36:35',
                'updated_at' => '2023-12-13 23:36:35',
            ),
            60 => 
            array (
                'id' => 61,
                'key' => 'browse_order_management',
                'table_name' => 'order_management',
                'created_at' => '2023-12-20 15:44:58',
                'updated_at' => '2023-12-20 15:44:58',
            ),
            61 => 
            array (
                'id' => 62,
                'key' => 'read_order_management',
                'table_name' => 'order_management',
                'created_at' => '2023-12-20 15:44:58',
                'updated_at' => '2023-12-20 15:44:58',
            ),
            62 => 
            array (
                'id' => 63,
                'key' => 'edit_order_management',
                'table_name' => 'order_management',
                'created_at' => '2023-12-20 15:44:58',
                'updated_at' => '2023-12-20 15:44:58',
            ),
            63 => 
            array (
                'id' => 64,
                'key' => 'add_order_management',
                'table_name' => 'order_management',
                'created_at' => '2023-12-20 15:44:58',
                'updated_at' => '2023-12-20 15:44:58',
            ),
            64 => 
            array (
                'id' => 65,
                'key' => 'delete_order_management',
                'table_name' => 'order_management',
                'created_at' => '2023-12-20 15:44:58',
                'updated_at' => '2023-12-20 15:44:58',
            ),
            65 => 
            array (
                'id' => 66,
                'key' => 'browse_transactions',
                'table_name' => 'transactions',
                'created_at' => '2023-12-20 16:04:42',
                'updated_at' => '2023-12-20 16:04:42',
            ),
            66 => 
            array (
                'id' => 67,
                'key' => 'read_transactions',
                'table_name' => 'transactions',
                'created_at' => '2023-12-20 16:04:42',
                'updated_at' => '2023-12-20 16:04:42',
            ),
            67 => 
            array (
                'id' => 68,
                'key' => 'edit_transactions',
                'table_name' => 'transactions',
                'created_at' => '2023-12-20 16:04:42',
                'updated_at' => '2023-12-20 16:04:42',
            ),
            68 => 
            array (
                'id' => 69,
                'key' => 'add_transactions',
                'table_name' => 'transactions',
                'created_at' => '2023-12-20 16:04:42',
                'updated_at' => '2023-12-20 16:04:42',
            ),
            69 => 
            array (
                'id' => 70,
                'key' => 'delete_transactions',
                'table_name' => 'transactions',
                'created_at' => '2023-12-20 16:04:42',
                'updated_at' => '2023-12-20 16:04:42',
            ),
            70 => 
            array (
                'id' => 71,
                'key' => 'browse_sub_orders',
                'table_name' => 'sub_orders',
                'created_at' => '2023-12-20 21:19:02',
                'updated_at' => '2023-12-20 21:19:02',
            ),
            71 => 
            array (
                'id' => 72,
                'key' => 'read_sub_orders',
                'table_name' => 'sub_orders',
                'created_at' => '2023-12-20 21:19:02',
                'updated_at' => '2023-12-20 21:19:02',
            ),
            72 => 
            array (
                'id' => 73,
                'key' => 'edit_sub_orders',
                'table_name' => 'sub_orders',
                'created_at' => '2023-12-20 21:19:02',
                'updated_at' => '2023-12-20 21:19:02',
            ),
            73 => 
            array (
                'id' => 74,
                'key' => 'add_sub_orders',
                'table_name' => 'sub_orders',
                'created_at' => '2023-12-20 21:19:02',
                'updated_at' => '2023-12-20 21:19:02',
            ),
            74 => 
            array (
                'id' => 75,
                'key' => 'delete_sub_orders',
                'table_name' => 'sub_orders',
                'created_at' => '2023-12-20 21:19:02',
                'updated_at' => '2023-12-20 21:19:02',
            ),
        ));
        
        
    }
}