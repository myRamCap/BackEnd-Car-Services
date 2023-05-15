<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::create([
        //     'first_name' => 'Jhon Ray',
        //     'middle_name' => 'Lorenzo',
        //     'last_name' => 'Angcon',
        //     'role' => '1',
        //     'email' => 'jhonrayangcon1423@gmail.com',
        //     'password' => bcrypt('welcome@123'),
        //     'contact_number' => '123456789',
        //     'image' => 'image_test'
        // ]);

        \App\Models\Role::insert([
            [ 'name' => 'Super Admin', 'created_at' => now(), 'updated_at' => now(), ],
            [ 'name' => 'Corporate Manager', 'created_at' => now(), 'updated_at' => now(), ],
            [ 'name' => 'Branch Manager', 'created_at' => now(), 'updated_at' => now(), ],
            [ 'name' => 'Branch Advisor', 'created_at' => now(), 'updated_at' => now(), ],
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\Service::factory(10)->create();

 
    }
}
