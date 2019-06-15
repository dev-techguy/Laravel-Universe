<?php

use App\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class UnitsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run() {
        //Fetch all Programs
        $programs = Program::query()->inRandomOrder()->get();

        foreach ($programs as $program) {
            $unitsOne = [
                [
                    'id' => Uuid::generate()->string,
                    'program_id' => $program->id,
                    'unit' => 'Unit ' . random_int(100, 500),
                    'semesterOne' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            $unitsTwo = [
                [
                    'id' => Uuid::generate()->string,
                    'program_id' => $program->id,
                    'unit' => 'Unit ' . random_int(100, 500),
                    'semesterTwo' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            DB::table('units')->insert($unitsOne);
            DB::table('units')->insert($unitsTwo);
        }
    }
}
