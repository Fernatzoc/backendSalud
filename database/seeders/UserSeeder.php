<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        User::factory()->count(1)
            ->create()
            ->each(
                function ($user) {
                    $user->assignRole('Administrador');
                }
            );

        User::factory()->count(1)
            ->create()
            ->each(
                function ($user) {
                    $user->assignRole('Personal');
                }
            );
    }
}
