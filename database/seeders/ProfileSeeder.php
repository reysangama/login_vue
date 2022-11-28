<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProfileSeeder extends Seeder
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
             'description'=>'Administrador',
             'created_at' => Carbon::now(),
             ]
        ];
        DB::table('profiles')->insert($data);

        DB::table('users')->insert([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => bcrypt('123456'),
            'profile_id' =>1,
            'created_at' => Carbon::now(),
        ]);
    }
}
