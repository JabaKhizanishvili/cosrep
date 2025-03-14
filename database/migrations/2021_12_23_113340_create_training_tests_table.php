<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id');
            $table->string("question");
            $table->longText("answers");
            $table->integer("correct");
            $table->timestamps();

            $table->foreign('training_id')
            ->references('id')
            ->on('trainings')
            ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_tests');
    }
}
