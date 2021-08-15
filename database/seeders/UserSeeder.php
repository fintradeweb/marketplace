<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Client']);

        $user1 = User::factory()->create();
        $user1->assignRole([$role->id]);

        $user2 = User::factory()->create();
        $user2->assignRole([$role->id]);

        $user3 = User::factory()->create();
        $user3->assignRole([$role->id]);

        $user4 = User::factory()->create();
        $user4->assignRole([$role->id]);

        $user5 = User::factory()->create();
        $user5->assignRole([$role->id]);
    }
}
