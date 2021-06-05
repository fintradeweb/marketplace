<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'name' => 'Nsa 1',
            'email' => 'correo1@gmail.com',            
            'token' => Str::random(10),
            'active' => '0',
        ]);

        DB::table('clients')->insert([
          'name' => 'Nsa 2',
          'email' => 'correo2@gmail.com',            
          'token' => Str::random(10),
          'active' => '1',
      ]);

        DB::table('clients')->insert([
          'name' => 'Nsa 3',
          'email' => 'correo3@gmail.com',            
          'token' => Str::random(10),
          'active' => '1',
      ]);

      DB::table('clients')->insert([
        'name' => 'Nsa 4',
        'email' => 'correo4@gmail.com',            
        'token' => Str::random(10),
        'active' => '0',
    ]);

      DB::table('clients')->insert([
        'name' => 'Nsa 5',
        'email' => 'correo5@gmail.com',            
        'token' => Str::random(10),
        'active' => '0',
    ]);

      DB::table('clients')->insert([
        'name' => 'Nsa 5',
        'email' => 'correo6@gmail.com',            
        'token' => Str::random(10),
        'active' => '0',
      ]);
    }
}