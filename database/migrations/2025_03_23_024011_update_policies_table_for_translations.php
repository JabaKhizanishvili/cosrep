<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdatePoliciesTableForTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('policies', function (Blueprint $table) {
            //
            $table->text('name')->change();
        });

        $items = DB::table('policies')->get();

        foreach ($items as $item) {
            DB::table('policies')
                ->where('id', $item->id)
                ->update([
                    'name' => json_encode(['ge' => $item->name, 'en' => $item->name]),
                    'text' => json_encode(['ge' => $item->text, 'en' => $item->text]),
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
        $items = DB::table('policies')->get();

        foreach ($items as $item) {
            $decoded = json_decode($item->name, true);
            $decoded1 = json_decode($item->text, true);
            DB::table('policies')
                ->where('id', $item->id)
                ->update([
                    'name' => $decoded['en'] ?? reset($decoded),
                    'text' => $decoded1['en'] ?? reset($decoded1),
                ]);
        }

        Schema::table('policies', function (Blueprint $table) {
            $table->string('name', 255)->change();
        });
    }
}
