<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeGroups extends Migration
{
    public function up()
    {
        Schema::create('attribute_groups', function (Blueprint $table) {
            $table->id();

            $table->string('attributable_type')->index();
            $table->json('name');
            $table->string('handle')->unique();
            $table->integer('position')->index();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attribute_groups');
    }
}
