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
                'id' => 3,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Lunch',
                'slug' => 'lunch',
                'created_at' => '2023-12-10 23:16:33',
                'updated_at' => '2024-02-23 19:45:00',
            ),
            1 => 
            array (
                'id' => 4,
                'parent_id' => NULL,
                'order' => 2,
                'name' => 'Dinner',
                'slug' => 'dinner',
                'created_at' => '2023-12-10 23:16:50',
                'updated_at' => '2024-03-18 01:27:17',
            ),
            2 => 
            array (
                'id' => 5,
                'parent_id' => NULL,
                'order' => 2,
                'name' => 'Brunch',
                'slug' => 'brunch',
                'created_at' => '2023-12-10 23:19:19',
                'updated_at' => '2024-03-18 01:27:03',
            ),
            3 => 
            array (
                'id' => 7,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Drinks',
                'slug' => 'drinks',
                'created_at' => '2024-03-18 13:23:16',
                'updated_at' => '2024-03-18 13:23:16',
            ),
        ));
        
        
    }
}