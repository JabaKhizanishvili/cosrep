<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeNameTranslatable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('pages', function (Blueprint $table) {
            //
            Schema::table('pages', function (Blueprint $table) {
                $table->text('name')->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            //
            Schema::table('pages', function (Blueprint $table) {
                $table->string('name')->change();
            });
        });
    }
}
