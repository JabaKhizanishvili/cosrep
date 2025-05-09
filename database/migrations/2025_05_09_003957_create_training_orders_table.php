<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_user_id');
            $table->unsignedBigInteger('training_id');
            $table->enum('type', ['online', 'offline']);
            $table->enum('status', ['pending', 'paid', 'expired', 'cancelled'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('access_expires_at')->nullable();
            $table->longText('test')->nullable(); // JSON ან serialized მონაცემი
            $table->longText('answers')->nullable(); // user's answers
            $table->integer('point_to_pass')->nullable();
            $table->integer('final_point')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->string('certificate')->nullable(); // ფაილის ბმული
            $table->timestamps();
            $table->foreign('external_user_id')->references('id')->on('external_users')->onDelete('cascade');
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_orders');
    }
}
