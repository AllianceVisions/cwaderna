<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadersReviewsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caders_reviews_pivot', function (Blueprint $table) {
            $table->foreignId('cader_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('rating');
            $table->text('comment');
            $table->boolean('status')->default(1);
            $table->boolean('viewed')->default(1);
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
        Schema::dropIfExists('caders_reviews_pivot');
    }
}
