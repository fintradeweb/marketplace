<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Super Administrador',
            'guard_name' => 'superadmin',            
        ]);

        DB::table('roles')->insert([
            'name' => 'Administrador',
            'guard_name' => 'admin',            
        ]);

        DB::table('roles')->insert([
            'name' => 'Cliente',
            'guard_name' => 'client',            
        ]);
    }
}
