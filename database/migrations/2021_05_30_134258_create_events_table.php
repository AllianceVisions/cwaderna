<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('event_organizer_id')->constrained('events_organizer');
            $table->foreignId('city_id')->constrained();
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('address');
            $table->string('status')->default('pending');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->text('description');
            $table->text('conditions');
            $table->time('start_attendance');
            $table->time('end_attendance');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
