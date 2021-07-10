<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsCadersPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_caders_pivot', function (Blueprint $table) {
            $table->foreignId('cader_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->integer('specialization_id');
            $table->datetime('start_attendance')->nullable();
            $table->datetime('end_attendance')->nullable();
            $table->double('price')->nullable();
            $table->double('profit')->nullable();
            $table->string('status')->nullable();
            $table->string('request_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_caders_pivot');
    }
}
