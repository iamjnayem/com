<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('units')->insert([
            'name' => 'kg',
            'status' => 1,
            'created_by' => 1
        ]);

        DB::table('units')->insert([
            'name' => 'pcs',
            'status' => 1,
            'created_by' => 1
        ]);

        DB::table('units')->insert([
            'name' => 'ltr',
            'status' => 1,
            'created_by' => 1
        ]);

        DB::table('units')->insert([
            'name' => 'gm',
            'status' => 1,
            'created_by' => 1
        ]);

    }
}
