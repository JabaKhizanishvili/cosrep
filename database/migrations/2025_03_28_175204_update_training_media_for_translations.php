<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateTrainingMediaForTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_media', function (Blueprint $table) {
            //
            $table->text('name')->nullable()->change();
            $table->text('path')->nullable()->change();
//            $table->text('path')->nullable()->change();
        });
        $items = DB::table('training_media')->get();
        foreach ($items as $item) {
            DB::table('training_media')->where('id', $item->id)->update([
                'name' => json_encode(['ge' => $item->name, 'en' => $item->name]),
                'path' => json_encode(['ge' => $item->path, 'en' => $item->path]),

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

        $items = DB::table('training_media')->get();

        foreach ($items as $item) {
            $decoded = json_decode($item->name, true);
            $decoded1 = json_decode($item->path, true);
            DB::table('training_media')
                ->where('id', $item->id)
                ->update([
                    'name' => $decoded['en'] ?? reset($decoded),
                    'path' => $decoded1['en'] ?? reset($decoded1),
                ]);
        }

        Schema::table('training_media', function (Blueprint $table) {
            //
            $table->string('name')->nullable()->change();
            $table->string('path')->change();

        });

    }
}
