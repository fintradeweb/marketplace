<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

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

        $faker = Faker::create();

        $user1 = User::factory()->create();
        $user1->assignRole([$role->id]);
        DB::table('businessinformations')->insert([
            'address' => $faker->address,
            'cell_phone' => $faker->phoneNumber,
            'city_id' => 11,
            'client_id' => 1,
            'company_name' => $faker->company,
            'contact_name' => $faker->name,
            'country_id' => 1,
            'date_company' => $faker->date($format = 'Y-m-d'),
            'dba' => Str::random(5),  
            'phone' => $faker->phoneNumber,  
            'president_name' => $faker->name, 
            'ruc_tax' => $faker->unique->randomDigit,  
            'secretary_name' => $faker->name, 
            'state_id' => 5,
            'type_business' => $faker->catchPhrase,
            'user_id' => $user1->id,
            'website' => '',
            'zip' => $faker->postcode,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $user2 = User::factory()->create();
        $user2->assignRole([$role->id]);
        DB::table('businessinformations')->insert([
            'address' => $faker->address,
            'cell_phone' => $faker->phoneNumber,
            'city_id' => 12,
            'client_id' => 1,
            'company_name' => $faker->company,
            'contact_name' => $faker->name,
            'country_id' => 1,
            'date_company' => $faker->date($format = 'Y-m-d'),
            'dba' => Str::random(5),  
            'phone' => $faker->phoneNumber,  
            'president_name' => $faker->name, 
            'ruc_tax' => $faker->unique->randomDigit,  
            'secretary_name' => $faker->name, 
            'state_id' => 5,
            'type_business' => $faker->catchPhrase,
            'user_id' => $user2->id,
            'website' => '',
            'zip' => $faker->postcode,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $user3 = User::factory()->create();
        $user3->assignRole([$role->id]);
        DB::table('businessinformations')->insert([
            'address' => $faker->address,
            'cell_phone' => $faker->phoneNumber,
            'city_id' => 13,
            'client_id' => 1,
            'company_name' => $faker->company,
            'contact_name' => $faker->name,
            'country_id' => 1,
            'date_company' => $faker->date($format = 'Y-m-d'),
            'dba' => Str::random(5),  
            'phone' => $faker->phoneNumber,  
            'president_name' => $faker->name, 
            'ruc_tax' => $faker->unique->randomDigit,  
            'secretary_name' => $faker->name, 
            'state_id' => 6,
            'type_business' => $faker->catchPhrase,
            'user_id' => $user3->id,
            'website' => '',
            'zip' => $faker->postcode,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $user4 = User::factory()->create();
        $user4->assignRole([$role->id]);
        DB::table('businessinformations')->insert([
            'address' => $faker->address,
            'cell_phone' => $faker->phoneNumber,
            'city_id' => 14,
            'client_id' => 1,
            'company_name' => $faker->company,
            'contact_name' => $faker->name,
            'country_id' => 1,
            'date_company' => $faker->date($format = 'Y-m-d'),
            'dba' => Str::random(5),  
            'phone' => $faker->phoneNumber,  
            'president_name' => $faker->name, 
            'ruc_tax' => $faker->unique->randomDigit,  
            'secretary_name' => $faker->name, 
            'state_id' => 6,
            'type_business' => $faker->catchPhrase,
            'user_id' => $user4->id,
            'website' => '',
            'zip' => $faker->postcode,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $user5 = User::factory()->create();
        $user5->assignRole([$role->id]);
        DB::table('businessinformations')->insert([
            'address' => $faker->address,
            'cell_phone' => $faker->phoneNumber,
            'city_id' => 15,
            'client_id' => 1,
            'company_name' => $faker->company,
            'contact_name' => $faker->name,
            'country_id' => 1,
            'date_company' => $faker->date($format = 'Y-m-d'),
            'dba' => Str::random(5),  
            'phone' => $faker->phoneNumber,  
            'president_name' => $faker->name, 
            'ruc_tax' => $faker->unique->randomDigit,  
            'secretary_name' => $faker->name, 
            'state_id' => 7,
            'type_business' => $faker->catchPhrase,
            'user_id' => $user5->id,
            'website' => '',
            'zip' => $faker->postcode,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
