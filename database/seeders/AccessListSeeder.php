<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccessListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_list')->insert([
            'user_id' => '1',
            'view' => '1',
            'edit' => '1',
            'add' => '1',
            'delete' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'), 
        ]);

        DB::table('access_list')->insert([
            'user_id' => '2',
            'view' => '1',
            'edit' => '1',
            'add' => '1',
            'delete' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'), 
        ]);
    }
}
