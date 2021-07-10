<?php

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
        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class,
            PermissionRoleSeeder::class,
            CitiesSeeder::class,
            UsersSeeder::class,
            RoleUserSeeder::class,
            SkillsSeeder::class,
            SpecializationSeeder::class,
        ]);
    }
}
