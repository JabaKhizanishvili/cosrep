<?php

use App\Models\AppointmentCustomer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('customer_id');
            $table->longText('test')->nullable();
            $table->longText('answers')->nullable();
            $table->integer("point_to_pass")->nullable();
            $table->integer("final_point")->nullable();
            $table->dateTime("started_at")->nullable();
            $table->dateTime("finished_at")->nullable();
            $table->enum('notified', [AppointmentCustomer::NOTIFIED_ONE, AppointmentCustomer::NOTIFIED_TWO])->nullable();
            $table->timestamps();
            //TODO Think
            $table->unique(['appointment_id', 'customer_id']);
            $table->foreign('appointment_id')
            ->references('id')
            ->on('appointments')
            ->onDelete('RESTRICT');

            $table->foreign('customer_id')
            ->references('id')
            ->on('customers')
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
        Schema::dropIfExists('appointment_customers');
    }
}
