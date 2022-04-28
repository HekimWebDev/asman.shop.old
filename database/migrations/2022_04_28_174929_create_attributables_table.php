<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributablesTable extends Migration
{
    public function up()
    {
        Schema::create('attributables', function (Blueprint $table) {
            $table->id();

            $table->morphs('attributable');
            $table->foreignId('attribute_id')->constrained('attributes');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attributables');
    }
}
