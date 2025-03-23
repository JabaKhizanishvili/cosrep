<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdatePartnersTableForTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
            //
            $table->text('name')->change();
        });

        $items = DB::table('partners')->get();
        foreach ($items as $item) {
            DB::table('partners')
                ->where('id', $item->id)
                ->update([
                    'name' => json_encode(['ge' => $item->name, 'en' => $item->name]),
                ]);


        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        $items = DB::table('partners')->get();

        foreach ($items as $item) {
            $decoded = json_decode($item->name, true);
            DB::table('partners')
                ->where('id', $item->id)
                ->update([
                    'name' => $decoded['en'] ?? reset($decoded),
                ]);
        }

        Schema::table('partners', function (Blueprint $table) {
            $table->string('name', 255)->change();
        });
    }
}
