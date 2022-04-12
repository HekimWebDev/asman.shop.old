<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            NestedSet::columns($table);
            $table->uuid('one_c_id')->unique();
            $table->uuid('one_c_parent_id')->nullable();
            $table->index(['one_c_id', 'one_c_parent_id']);
            $table->bigInteger('order')->default(0);
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('one_c_parent_id')
                ->references('one_c_id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
