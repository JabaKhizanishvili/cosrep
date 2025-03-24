<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateAboutsTableForTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('abouts', function (Blueprint $table) {
            //
            $table->text('title')->change();
        });

        $items = DB::table('abouts')->get();

        foreach ($items as $item) {
            DB::table('abouts')
                ->where('id', $item->id)
                ->update([
                    'title' => json_encode(['ge' => $item->title, 'en' => $item->title]),
                    'text' => json_encode(['ge' => $item->text, 'en' => $item->text]),
                    'stats' => json_encode(['ge' => $item->stats, 'en' => $item->stats]),
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
        Schema::table('abouts', function (Blueprint $table) {
            //
            $table->string('title')->change();
        });

        $items = DB::table('abouts')->get();

        foreach ($items as $item) {
            $decoded = json_decode($item->title, true);
            $decoded1 = json_decode($item->text, true);
            $decoded2 = json_decode($item->stats, true);
            DB::table('abouts')->where('id', $item->id)->update([
                'title' => $decoded['en'] ?? reset($decoded),
                'text' => $decoded['en'] ?? reset($decoded1),
                'stats' => $decoded['en'] ?? reset($decoded2),
            ]);
        }
    }
}
