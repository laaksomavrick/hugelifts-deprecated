<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutineScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routine_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('routine_id');
            $table->foreign('routine_id')->references('id')->on('routines')->onDelete('cascade');
            $table->unsignedInteger('routine_day_id');
            $table->foreign('routine_day_id')->references('id')->on('routine_days')->onDelete('cascade');
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
        Schema::dropIfExists('routine_schedules');
    }
}
