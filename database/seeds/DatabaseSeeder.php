<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(ProgramsTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(CountyTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AdminTableSeeder::class);
    }
}
