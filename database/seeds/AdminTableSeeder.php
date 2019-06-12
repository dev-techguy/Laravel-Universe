<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class AdminTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run() {
        //create new instance of faker
        $faker = new Faker();

        //create custom users here
        $demoAdmins = [
            [
                'id' => Uuid::generate()->string,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('admin@test'),
            ],
        ];

        //store here
        DB::table('admins')->insert($demoAdmins);
    }
}
