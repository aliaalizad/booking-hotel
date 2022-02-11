<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Contract;
use App\Models\Hotel;
use App\Models\Manager;
use App\Models\Member;
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
        // \App\Models\User::factory(10)->create();
        Admin::factory(1)->create();

        Contract::factory(2)
            ->has(Manager::factory()->count(2)
            ->has(Hotel::factory()->count(3))
        )->create();

        Member::factory(200)->create();
    }
}
