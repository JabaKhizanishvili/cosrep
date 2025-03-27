<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateTrainingTestsTableForTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_tests', function (Blueprint $table) {
            $table->longText('question')->change();
        });

        $items = DB::table('training_tests')->get();
        foreach ($items as $item) {
            DB::table('training_tests')->where('id', $item->id)->update([
                'question' => json_encode(['ge' => $item->question, 'en' => $item->question]),
                'answers' => json_encode(['ge' => $item->answers, 'en' => $item->answers]),

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

        $items = DB::table('training_tests')->get();

        foreach ($items as $item) {
            $decoded = json_decode($item->question, true);
            $decoded1 = json_decode($item->answers, true);
            DB::table('training_tests')
                ->where('id', $item->id)
                ->update([
                    'question' => $decoded['en'] ?? reset($decoded),
                    'answers' => $decoded1['en'] ?? reset($decoded1),
                ]);
        }


        Schema::table('training_tests', function (Blueprint $table) {
            //
            $table->string("question")->change();
        });
    }
}
