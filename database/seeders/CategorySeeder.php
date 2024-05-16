<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'fruits',
            'status' => 1,
            'created_by' => 1
        ]);

        DB::table('categories')->insert([
            'name' => 'vegetables',
            'status' => 1,
            'created_by' => 1
        ]); 
        
        DB::table('categories')->insert([
            'name' => 'utilities',
            'status' => 1,
            'created_by' => 1
        ]); 
        
        DB::table('categories')->insert([
            'name' => 'fashions',
            'status' => 1,
            'created_by' => 1
        ]); 

        DB::table('categories')->insert([
            'name' => 'electronics',
            'status' => 1,
            'created_by' => 1
        ]); 

        DB::table('categories')->insert([
            'name' => 'gifts',
            'status' => 1,
            'created_by' => 1
        ]); 

        DB::table('categories')->insert([
            'name' => 'arts & crafts',
            'status' => 1,
            'created_by' => 1
        ]); 

        DB::table('categories')->insert([
            'name' => 'cosmetics',
            'status' => 1,
            'created_by' => 1
        ]);
         
        DB::table('categories')->insert([
            'name' => 'drinks',
            'status' => 1,
            'created_by' => 1
        ]);
    }
}
