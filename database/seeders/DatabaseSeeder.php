<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            RenditionsTableSeeder::class,
            CategoriesTableSeeder::class,
            FeaturedArticlesListAtbleSeeder::class,
            AuthorsTableSeeder::class,
//            ArticlesTableSeeder::class
        ]);
    }
}
