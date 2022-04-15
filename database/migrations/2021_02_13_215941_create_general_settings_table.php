<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name',255);
            $table->string('address',255);
            $table->string('phone',255);
            $table->string('email',255);
            $table->text('who_are_we');
            $table->text('our_goal');
            $table->text('our_vision');
            $table->text('our_message');
            $table->boolean('sign_up_status')->default(1);
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
        Schema::dropIfExists('general_settings');
    }
}
