<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientSeeder::class);
        $this->call(MessagesSeeder::class);
        $this->call(CatalogosSeeder::class);
        $this->call(SuperAdminUserSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(UserSeeder::class);
    }
}
