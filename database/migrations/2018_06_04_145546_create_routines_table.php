<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->boolean('active')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('routine_days', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('routine_id');
            $table->foreign('routine_id')->references('id')->on('routines');
            $table->string('name');
            $table->unsignedTinyInteger('ordinal');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('routine_day_exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('exercise_id');
            $table->unsignedInteger('routine_day_id');
            $table->foreign('exercise_id')->references('id')->on('exercises');
            $table->foreign('routine_day_id')->references('id')->on('routine_days');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('sets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('routine_day_exercise_id');
            $table->foreign('routine_day_exercise_id')->references('id')->on('routine_day_exercises');
            $table->unsignedTinyInteger('reps');
            $table->unsignedTinyInteger('percentage');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sets');
        Schema::dropIfExists('routine_day_exercises');
        Schema::dropIfExists('routine_days');
        Schema::dropIfExists('routines');
    }
}
