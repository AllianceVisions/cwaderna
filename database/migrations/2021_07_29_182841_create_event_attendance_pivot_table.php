<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAttendancePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_attendance_pivot', function (Blueprint $table) {
            $table->foreignId('cader_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('type')->default('attend'); // حضور او انصراف
            $table->tinyInteger('out_of_zone')->default(0); // هل تم تسجيل الحضور خارج نطاق الفعالية
            $table->date('attendance1')->nullable(); 
            $table->time('attendance2')->nullable(); 
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->double('distance')->nullable(); // المسافة بينه وبين مكان الفعالية المحدد
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_attendance_pivot');
    }
}
