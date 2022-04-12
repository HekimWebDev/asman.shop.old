<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('car_model_id')
                ->nullable()
                ->constrained('car_models')
                ->onDelete('set null');
            $table->year('year');
            $table->foreignId('car_body_id')
                ->nullable()
                ->constrained('car_bodies')
                ->onDelete('set null');
            $table->unsignedBigInteger('mileage');
            $table->string('motor');
            $table->foreignId('car_transmission_id')
                ->nullable()
                ->constrained('car_transmissions')
                ->onDelete('set null');
            $table->foreignId('car_type_of_drive_id')
                ->nullable()
                ->constrained('car_type_of_drives')
                ->onDelete('set null');
            $table->foreignId('car_colour_id')
                ->nullable()
                ->constrained('car_colours')
                ->onDelete('set null');
            $table->string('vin_code');
            $table->string('price');
            $table->foreignId('car_place_id')
                ->nullable()
                ->constrained('car_places')
                ->onDelete('set null');
            $table->boolean('can_credit')->default(false);
            $table->boolean('can_exchange')->default(false);
            $table->longText('additional')->nullable();
            $table->boolean('can_comment')->default(true);
            $table->string('slug');
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('car_ads');
    }
}