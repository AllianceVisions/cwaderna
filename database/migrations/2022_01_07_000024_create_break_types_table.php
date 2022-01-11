<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreakTypesTable extends Migration
{
    public function up()
    {
        Schema::create('break_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->Integer('time');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
