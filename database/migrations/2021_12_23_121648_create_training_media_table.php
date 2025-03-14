<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id');
            $table->enum('type', ['document', 'video']);
            $table->string('path');
            $table->string('name');
            $table->integer('position')->nullable();
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
        Schema::dropIfExists('training_media');
    }
}
