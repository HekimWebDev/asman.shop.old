<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarAdTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_ad_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_ad_id')
                ->constrained('car_ads')
                ->cascadeOnDelete();
            $table->enum('type', ['premium']);
            $table->boolean('is_active')->default(false);
            $table->dateTime('expire_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_ad_types');
    }
}
