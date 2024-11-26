<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{

    public function run(): void
    {
        foreach (RoleEnum::toArray() as $role) {
            Role::query()
                ->create([
                             'name'       => $role,
                             'guard_name' => 'api',
                         ]
                );
        }
    }
}
