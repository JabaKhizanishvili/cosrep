<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateBlogsForTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
            $table->text('name')->change();
        });

        $items = DB::table('blogs')->get();

        foreach ($items as $item) {
            DB::table('blogs')
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
        Schema::table('blogs', function (Blueprint $table) {
            //
            $table->text('name')->change();
        });

        $items = DB::table('blogs')->get();

        foreach ($items as $item) {
            $decoded = json_decode($item->name, true);
            $decoded1 = json_decode($item->text, true);
            DB::table('blogs')->where('id', $item->id)->update([
                'name' => $decoded['en'] ?? reset($decoded),
                'text' => $decoded['en'] ?? reset($decoded1),
            ]);
        }
    }
}
