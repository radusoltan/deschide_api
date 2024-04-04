<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'article-list',
            'article-create',
            'article-edit',
            'article-delete',
            'author-list',
            'author-create',
            'author-edit',
            'author-delete',
            'list-list',
            'list-edit',
            'list-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
