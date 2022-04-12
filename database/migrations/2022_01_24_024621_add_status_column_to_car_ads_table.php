<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnToCarAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_ads', function (Blueprint $table) {
            $table->enum('status', ['archived', 'processing', 'published', 'waiting'])
                ->default('waiting')
                ->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_ads', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
