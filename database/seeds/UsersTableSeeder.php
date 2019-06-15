<?php

use App\SemesterOne;
use App\SemesterTwo;
use App\User;
use Illuminate\Database\Seeder;
use MV\Notification\Models\Notification;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run() {
        factory(User::class, 1)->create()->each(function ($user) {
            $user->notification()->save(factory(Notification::class)->make());
            $user->semester_one()->save(factory(SemesterOne::class)->make());
            $user->semester_two()->save(factory(SemesterTwo::class)->make());
        });
    }
}
