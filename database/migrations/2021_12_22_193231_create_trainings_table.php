<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainer_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name')->unique();
            $table->text('text');
            $table->string('image')->default("noimage.jpg");
            $table->integer('status')->default(1); //1 active    2 - Inactive (Default is Inactive)
            $table->integer('point_to_pass');
            $table->longText('resources')->nullable();
            $table->timestamps();

            $table->foreign('trainer_id')
            ->references('id')
            ->on('trainers')
            ->onDelete('RESTRICT');

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
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
        Schema::dropIfExists('trainings');
    }
}
