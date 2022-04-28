<?php

declare(strict_types=1);

use Kalnoy\Nestedset\NestedSet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('rinvex.categories.tables.categories'), function (Blueprint $table) {
            // Columns
            $table->increments('id');
            $table->string('slug');
            $table->boolean('status')->default(false);
            $table->json('name');
            $table->json('description')->nullable();
            NestedSet::columns($table);
            $table->boolean('is_main')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('rinvex.categories.tables.categories'));
    }
}
