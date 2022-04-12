<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brands')
                ->onDelete('set null');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->onDelete('set null');
            $table->uuid('one_c_id')->unique();
            $table->uuid('one_c_category_id')->nullable();
            $table->index(['one_c_id', 'one_c_category_id']);
            $table->decimal('price')->nullable();
            $table->decimal('discount_price')->nullable();
            $table->string('vendor_code')->nullable();
            $table->boolean('hit')->default(0);
            $table->string('image')->nullable();
            $table->integer('quantity')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('one_c_category_id')
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
        Schema::dropIfExists('products');
    }
}
