<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class ProgramsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run() {
        $programs = [
            [
                'id' => Uuid::generate()->string,
                'name' => 'Bsc. Applied Computer Science',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Bsc. Software Engineering',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Bsc. Computer Science',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::generate()->string,
                'name' => 'Bsc. Information Technology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        //store
        DB::table('programs')->insert($programs);
    }
}
