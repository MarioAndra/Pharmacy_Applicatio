<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeed::class);

        $user=User::create(['name'=>'mario',
        'number'=>'0937723418',
        'email'=>'mario@gamil.com',
        'password'=>'123456789',
        'role_id'=>1
    ]);


    }
}
