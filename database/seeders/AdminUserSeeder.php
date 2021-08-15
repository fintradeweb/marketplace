<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Fernanda Fueltala', 
            'email' => 'ffueltala@fintradeweb.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'status' => 1            
        ]);

        $user2 = User::create([
            'name' => 'Miguel Flores', 
            'email' => 'mflores@fintradeweb.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'status' => 1
        ]);
    
        $role = Role::create(['name' => 'Admin']);
        $user1->assignRole([$role->id]);
        $user2->assignRole([$role->id]);
    }
}
