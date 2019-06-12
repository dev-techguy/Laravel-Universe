<?php

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
        //create custom users here
        $demoAdmins = [
            [
                'id' => Uuid::generate()->string,
                'name' => 'admin',
                'email' => 'admin@test',
                'password' => Hash::make('admin@test'),
            ],
        ];

        //store here
        DB::table('admins')->insert($demoAdmins);
    }
}
