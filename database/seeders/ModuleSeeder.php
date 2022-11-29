<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data=[
       [ 'description'=>'Seguridad',
        'url'=>'',
        'parent_module'=>0,
        'icon'=>'fa fa-lock',
        'order'=>1,
        'created_at' => Carbon::now(),
        ],
        [ 'description'=>'Mantenimiento',
        'url'=>'',
        'parent_module'=>0,
        'icon'=>'fa fa-gear',
        'order'=>1,
        'created_at' => Carbon::now(),
        ],
        [ 'description'=>'Perfiles',
        'url'=>'/profile',
        'parent_module'=>1,
        'icon'=>'pi pi-lock',
        'order'=>2,
        'created_at' => Carbon::now(),],
        [ 'description'=>'Proveedor',
        'url'=>'/provider',
        'parent_module'=>2,
        'icon'=>'pi pi-lock',
        'order'=>2,
        'created_at' => Carbon::now(),],
        [ 'description'=>'Usuarios',
        'url'=>'/user',
        'parent_module'=>1,
        'icon'=>'pi pi-lock',
        'order'=>2,
        'created_at' => Carbon::now(),],
         [ 'description'=>'Clientes',
        'url'=>'/customer',
        'parent_module'=>2,
        'icon'=>'pi pi-lock',
        'order'=>2,
        'created_at' => Carbon::now(),],
       ];
       DB::table('modules')->insert($data);
    }
}
