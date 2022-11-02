<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
             'module_id'=>1,
             'perfil_id'=>1,
             'created_at' => Carbon::now(),
             ]
        ];
        DB::table('permissions')->insert($data);
        
    }
}
