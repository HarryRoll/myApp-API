<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    
        User::create([
            'username' => 'admin01',
            'roles' => 'admin',
            'password' => bcrypt("123456")
        ]);

        User::create([
            'username' => 'user01',
            'roles' => 'user',
            'password' => bcrypt("123456789")
        ]);
    }
}
