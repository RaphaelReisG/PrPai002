<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

        User::create(['id' => 1, ]);


        Permission::create(['name' => 'admin', 'guard_name' => 'web']);
        Permission::create(['name' => 'vendedor', 'guard_name' => 'web']);
        Permission::create(['name' => 'user', 'guard_name' => 'web']);
    }
}
