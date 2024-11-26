<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            RoleSeeder::class,
            BranchSeeder::class,
            TariffSeeder::class,
        ]);


        $admin = User::query()
            ->create([
                         'full_name'    => 'Admin',
                         'phone_number' => '998972113355',
                         'password'     => bcrypt('password'),
                     ]);
        $admin->assignRole(RoleEnum::ADMIN);

        $dispatcher = User::query()
            ->create([
                         'full_name'    => 'Dispatcher',
                         'phone_number' => '998972113356',
                         'password'     => bcrypt('password'),
                     ]);

        $dispatcher->assignRole(RoleEnum::DISPATCHER);

    }
}
