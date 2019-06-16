<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemesterTwosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('semester_twos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('unit_id');
            $table->uuid('user_id');
            $table->double('catOne', 2)->default(0);
            $table->double('catTwo', 2)->default(0);
            $table->double('mainExam', 2)->default(0);
            $table->double('average', 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('semester_twos');
    }
}
