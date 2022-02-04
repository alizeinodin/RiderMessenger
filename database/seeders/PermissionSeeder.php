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
        Permission::create(['name' => 'read message', 'guard_name' => 'api']);
        Permission::create(['name' => 'write message', 'guard_name' => 'api']);
        Permission::create(['name' => 'edit message', 'guard_name' => 'api']);
        Permission::create(['name' => 'delete message', 'guard_name' => 'api']);
    }
}
