<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $permissions = [
            'chillers-list',
            'chillers-view',
            'chillers-create',
            'chillers-edit',
            'chillers-delete',

            'customers-list',
            'customers-view',
            'customers-create',
            'customers-edit',
            'customers-delete',

            'projects-list',
            'projects-view',
            'projects-create',
            'projects-edit',
            'projects-delete',

            'blogs-list',
            'blogs-view',
            'blogs-create',
            'blogs-edit',
            'blogs-delete',

            'brands-list',
            'brands-view',
            'brands-create',
            'brands-edit',
            'brands-delete',

            'models-list',
            'models-view',
            'models-create',
            'models-edit',
            'models-delete',

            'contacts-list',
            'contacts-view',
            'contacts-create',
            'contacts-edit',
            'contacts-delete',

            'newsLetters-list',
            'newsLetters-view',
            'newsLetters-create',
            'newsLetters-edit',
            'newsLetters-delete',

            'roles-list',
            'roles-view',
            'roles-create',
            'roles-edit',
            'roles-delete',

            'users-list',
            'users-view',
            'users-create',
            'users-edit',
            'users-delete',

            'notifications-list',
            'notifications-view',
            'notifications-create',
            'notifications-edit',
            'notifications-delete',

            'audits-list',
            'audits-view',
            'audits-create',
            'audits-edit',
            'audits-delete',

            'logs-list',
            'logs-view',
            'logs-create',
            'logs-edit',
            'logs-delete',

            'settings-list',
            'settings-create',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
