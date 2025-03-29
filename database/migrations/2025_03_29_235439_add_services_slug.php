<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddServicesSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->after('id');
        });

        $items = DB::table('services')->get();

        foreach ($items as $item) {
            $decoded = json_decode($item->name, true);
            $slugValue = Str::slug($decoded['en'] ?? reset($decoded));

            // Ensure slug is not empty
            if (empty($slugValue)) {
                $slugValue = 'service-'.$item->id;
            }

            // Ensure slug is unique
            $count = DB::table('services')
                ->where('slug', $slugValue)
                ->where('id', '!=', $item->id)
                ->count();

            if ($count > 0) {
                $slugValue .= '-'.$item->id;
            }

            DB::table('services')->where('id', $item->id)->update([
                'slug' => $slugValue
            ]);
        }

        // Now add the unique constraint after all data is cleaned
        Schema::table('services', function (Blueprint $table) {
            $table->unique('slug', 'services_slug_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
