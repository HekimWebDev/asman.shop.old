<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAsmanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->dateTime('last_activity')->nullable();
        });

        Schema::create('advertisement_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('advertisement_products_user_id_foreign');
//            $table->unsignedBigInteger('category_id')->nullable()->index('advertisement_products_category_id_foreign');
            $table->string('slug');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->decimal('price');
            $table->integer('quantity')->default(1);
            $table->string('image');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('advertisement_products_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('advertisement_product_id')->index('advertisement_products_images_advertisement_product_id_foreign');
            $table->string('image');
            $table->timestamps();
        });

        /*Schema::create('attribute_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attribute_id')->index('attribute_translations_attribute_id_foreign');
            $table->string('locale')->index();
            $table->string('name');
            $table->longText('description')->nullable();
        });*/

        /*Schema::create('attribute_value_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attribute_value_id')->index('attribute_value_translations_attribute_value_id_foreign');
            $table->string('locale')->index();
            $table->string('name');
        });*/

        /*Schema::create('attribute_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attribute_id')->index('attribute_values_attribute_id_foreign');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });*/

        /*Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attribute_group_id')->index('attributes_attribute_group_id_foreign');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });*/

        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('block_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('block_id')->index('block_product_block_id_foreign');
            $table->unsignedBigInteger('product_id')->index('block_product_product_id_foreign');
            $table->timestamps();
        });

        Schema::create('block_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('block_id')->index('block_translations_block_id_foreign');
            $table->string('locale')->index();
            $table->string('slug');
            $table->string('name');
        });

        Schema::create('blocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('blog_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order')->default(0);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('blog_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_category_id')->index('blog_category_translations_blog_category_id_foreign');
            $table->string('locale')->index();
            $table->string('slug');
            $table->string('name');
        });

        Schema::create('blog_post_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_post_id')->nullable()->index('blog_post_comments_blog_post_id_foreign');
            $table->unsignedBigInteger('user_id')->nullable()->index('blog_post_comments_user_id_foreign');
            $table->longText('message');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('blog_post_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_post_id')->index('blog_post_tag_blog_post_id_foreign');
            $table->unsignedBigInteger('blog_tag_id')->index('blog_post_tag_blog_tag_id_foreign');
            $table->timestamps();
        });

        Schema::create('blog_post_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_post_id')->index('blog_post_translations_blog_post_id_foreign');
            $table->string('locale')->index();
            $table->string('slug');
            $table->string('name');
            $table->longText('description')->nullable();
        });

        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_category_id')->nullable()->index('blog_posts_blog_category_id_foreign');
            $table->string('image')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('blog_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('slug');
            $table->string('name');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('car_ad_phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_ad_id')->index('car_ad_phones_car_ad_id_foreign');
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('car_ad_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_ad_id')->index('car_ad_types_car_ad_id_foreign');
            $table->enum('type', ['premium']);
            $table->boolean('is_active')->default(false);
            $table->dateTime('expire_date')->nullable();
            $table->timestamps();
        });

        Schema::create('car_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('car_ads_user_id_foreign');
            $table->unsignedBigInteger('car_model_id')->nullable()->index('car_ads_car_model_id_foreign');
            $table->year('year');
            $table->unsignedBigInteger('car_body_id')->nullable()->index('car_ads_car_body_id_foreign');
            $table->unsignedBigInteger('mileage');
            $table->string('motor');
            $table->unsignedBigInteger('car_transmission_id')->nullable()->index('car_ads_car_transmission_id_foreign');
            $table->unsignedBigInteger('car_type_of_drive_id')->nullable()->index('car_ads_car_type_of_drive_id_foreign');
            $table->unsignedBigInteger('car_colour_id')->nullable()->index('car_ads_car_colour_id_foreign');
            $table->decimal('price');
            $table->unsignedBigInteger('car_place_id')->nullable()->index('car_ads_car_place_id_foreign');
            $table->boolean('can_credit')->default(false);
            $table->boolean('can_exchange')->default(false);
            $table->longText('additional')->nullable();
            $table->boolean('can_comment')->default(true);
            $table->string('slug');
            $table->enum('status', ['archived', 'processing', 'published', 'waiting'])->default('waiting');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('car_bodies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('car_body_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_body_id')->index('car_body_translations_car_body_id_foreign');
            $table->string('locale')->index();
            $table->string('name');
        });

        Schema::create('car_brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('car_colour_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_colour_id')->index('car_colour_translations_car_colour_id_foreign');
            $table->string('locale')->index();
            $table->string('name');
        });

        Schema::create('car_colours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('car_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_brand_id')->nullable()->index('car_models_car_brand_id_foreign');
            $table->string('name');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('car_place_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_place_id')->index('car_place_translations_car_place_id_foreign');
            $table->string('locale')->index();
            $table->string('name');
        });

        Schema::create('car_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('_lft')->default('0');
            $table->unsignedInteger('_rgt')->default('0');
            $table->unsignedInteger('parent_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->index(['_lft', '_rgt', 'parent_id']);
        });

        Schema::create('car_transmission_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_transmission_id')->index('car_transmission_translations_car_transmission_id_foreign');
            $table->string('locale')->index();
            $table->string('name');
        });

        Schema::create('car_transmissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('car_type_of_drive_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('car_type_of_drive_id')->index('car_type_of_drive_translations_car_type_of_drive_id_foreign');
            $table->string('locale')->index();
            $table->string('name');
        });

        Schema::create('car_type_of_drives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        /*Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('_lft')->default('0');
            $table->unsignedInteger('_rgt')->default('0');
            $table->unsignedInteger('parent_id')->nullable();
            $table->char('one_c_id', 36)->unique();
            $table->char('one_c_parent_id', 36)->nullable()->index('categories_one_c_parent_id_foreign');
            $table->boolean('is_main')->nullable();
            $table->bigInteger('position')->default(0);
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->index(['one_c_id', 'one_c_parent_id']);
            $table->index(['_lft', '_rgt', 'parent_id']);
        });*/

        /*Schema::create('category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->index('category_translations_category_id_foreign');
            $table->string('locale')->index();
            $table->string('slug');
            $table->string('name');
            $table->longText('description')->nullable();
        });*/

        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->index('companies_user_id_foreign');
            $table->string('name');
            $table->string('website')->nullable();
            $table->string('tin');
            $table->string('fax_address')->nullable();
            $table->string('about');
            $table->timestamps();
        });

        Schema::create('desired_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('desired_products_product_id_foreign');
            $table->unsignedBigInteger('user_id')->nullable()->index('desired_products_user_id_foreign');
            $table->timestamps();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('logos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo')->nullable();
            $table->string('small_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->timestamps();
        });

        /*Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->char('uuid', 36)->nullable()->unique();
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk');
            $table->string('conversions_disk')->nullable();
            $table->unsignedBigInteger('size');
            $table->longText('manipulations');
            $table->longText('custom_properties');
            $table->longText('generated_conversions');
            $table->longText('responsive_images');
            $table->unsignedInteger('order_column')->nullable();
            $table->timestamps();

            $table->index(['model_type', 'model_id']);
        });*/

        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->index(['model_id', 'model_type']);
            $table->primary(['permission_id', 'model_id', 'model_type']);
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');

            $table->index(['model_id', 'model_type']);
            $table->primary(['role_id', 'model_id', 'model_type']);
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('type');
            $table->string('notifiable_type');
            $table->unsignedBigInteger('notifiable_id');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['notifiable_type', 'notifiable_id']);
        });

        Schema::create('order_online_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->nullable()->index('order_online_payments_order_id_foreign');
            $table->char('bank_order_id', 36);
            $table->timestamps();
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('order_products_order_id_foreign');
            $table->unsignedBigInteger('product_id')->nullable()->index('order_products_product_id_foreign');
            $table->string('name');
            $table->decimal('price');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('uuid', 36);
            $table->unsignedBigInteger('user_id')->nullable()->index('orders_user_id_foreign');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->longText('address');
            $table->longText('comment')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('payment_type_id')->nullable()->index('orders_payment_type_id_foreign');
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('payment_type_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_type_id')->index('payment_type_translations_payment_type_id_foreign');
            $table->string('locale')->index();
            $table->string('name');
            $table->string('slug');
        });

        Schema::create('payment_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        /*Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tokenable_type');
            $table->unsignedBigInteger('tokenable_id');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();

            $table->index(['tokenable_type', 'tokenable_id']);
        });*/

        /*Schema::create('product_attribute_value', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('attribute_value_id')->index('product_attribute_value_attribute_value_id_foreign');
            $table->unsignedBigInteger('product_id')->index('product_attribute_value_product_id_foreign');
            $table->timestamps();
        });*/

        Schema::create('product_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('product_images_product_id_foreign');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('product_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->index('product_translations_product_id_foreign');
            $table->string('locale')->index();
            $table->string('slug');
            $table->string('name');
            $table->longText('description')->nullable();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('brand_id')->nullable()->index('products_brand_id_foreign');
//            $table->unsignedBigInteger('category_id')->nullable()->index('products_category_id_foreign');
//            $table->char('one_c_id', 36)->unique();
//            $table->char('one_c_category_id', 36)->nullable()->index('products_one_c_category_id_foreign');
            $table->decimal('price')->nullable();
            $table->decimal('discount_price')->nullable();
            $table->string('vendor_code')->nullable();
            $table->boolean('hit')->default(false);
            $table->string('image')->nullable();
            $table->integer('quantity')->default(0);
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();

//            $table->index(['one_c_id', 'one_c_category_id']);
        });

        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id')->index('role_has_permissions_role_id_foreign');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create('service_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order')->default(0);
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('service_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_category_id')->index('service_category_translations_service_category_id_foreign');
            $table->string('locale')->index();
            $table->string('slug');
            $table->string('name');
        });

        Schema::create('service_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id')->index('service_translations_service_id_foreign');
            $table->string('locale')->index();
            $table->string('slug');
            $table->string('name');
            $table->string('owner')->nullable();
            $table->string('address');
            $table->longText('description')->nullable();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_category_id')->nullable()->index('services_service_category_id_foreign');
            $table->string('image')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group')->index();
            $table->string('name');
            $table->boolean('locked');
            $table->longText('payload');
            $table->timestamps();
        });

        Schema::create('slider_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('slider_id')->index('slider_translations_slider_id_foreign');
            $table->string('locale')->index();
            $table->string('image');
        });

        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order')->default(0);
            $table->longText('link')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('subscribers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('uuid', 36)->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('password');
            $table->rememberToken();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->dateTime('last_activity')->nullable();
        });

        Schema::table('advertisement_products', function (Blueprint $table) {
//            $table->foreign(['category_id'])->references(['id'])->on('categories')->onDelete('SET NULL');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });

        Schema::table('advertisement_products_images', function (Blueprint $table) {
            $table->foreign(['advertisement_product_id'])->references(['id'])->on('advertisement_products')->onDelete('CASCADE');
        });

        /*Schema::table('attribute_group_translations', function (Blueprint $table) {
            $table->foreign(['attribute_group_id'])->references(['id'])->on('attribute_groups')->onDelete('CASCADE');
        });

        Schema::table('attribute_translations', function (Blueprint $table) {
            $table->foreign(['attribute_id'])->references(['id'])->on('attributes')->onDelete('CASCADE');
        });

        Schema::table('attribute_value_translations', function (Blueprint $table) {
            $table->foreign(['attribute_value_id'])->references(['id'])->on('attribute_values')->onDelete('CASCADE');
        });*/

        /*Schema::table('attribute_values', function (Blueprint $table) {
            $table->foreign(['attribute_id'])->references(['id'])->on('attributes')->onDelete('CASCADE');
        });*/

        /*Schema::table('attributes', function (Blueprint $table) {
            $table->foreign(['attribute_group_id'])->references(['id'])->on('attribute_groups')->onDelete('CASCADE');
        });*/

        Schema::table('block_product', function (Blueprint $table) {
            $table->foreign(['block_id'])->references(['id'])->on('blocks')->onDelete('CASCADE');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
        });

        Schema::table('block_translations', function (Blueprint $table) {
            $table->foreign(['block_id'])->references(['id'])->on('blocks')->onDelete('CASCADE');
        });

        Schema::table('blog_category_translations', function (Blueprint $table) {
            $table->foreign(['blog_category_id'])->references(['id'])->on('blog_categories')->onDelete('CASCADE');
        });

        Schema::table('blog_post_comments', function (Blueprint $table) {
            $table->foreign(['blog_post_id'])->references(['id'])->on('blog_posts')->onDelete('SET NULL');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('SET NULL');
        });

        Schema::table('blog_post_tag', function (Blueprint $table) {
            $table->foreign(['blog_post_id'])->references(['id'])->on('blog_posts')->onDelete('CASCADE');
            $table->foreign(['blog_tag_id'])->references(['id'])->on('blog_tags')->onDelete('CASCADE');
        });

        Schema::table('blog_post_translations', function (Blueprint $table) {
            $table->foreign(['blog_post_id'])->references(['id'])->on('blog_posts')->onDelete('CASCADE');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->foreign(['blog_category_id'])->references(['id'])->on('blog_categories')->onDelete('SET NULL');
        });

        Schema::table('car_ad_phones', function (Blueprint $table) {
            $table->foreign(['car_ad_id'])->references(['id'])->on('car_ads')->onDelete('CASCADE');
        });

        Schema::table('car_ad_types', function (Blueprint $table) {
            $table->foreign(['car_ad_id'])->references(['id'])->on('car_ads')->onDelete('CASCADE');
        });

        Schema::table('car_ads', function (Blueprint $table) {
            $table->foreign(['car_place_id'])->references(['id'])->on('car_places')->onDelete('SET NULL');
            $table->foreign(['car_type_of_drive_id'])->references(['id'])->on('car_type_of_drives')->onDelete('SET NULL');
            $table->foreign(['car_body_id'])->references(['id'])->on('car_bodies')->onDelete('SET NULL');
            $table->foreign(['car_model_id'])->references(['id'])->on('car_models')->onDelete('SET NULL');
            $table->foreign(['car_transmission_id'])->references(['id'])->on('car_transmissions')->onDelete('SET NULL');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['car_colour_id'])->references(['id'])->on('car_colours')->onDelete('SET NULL');
        });

        Schema::table('car_body_translations', function (Blueprint $table) {
            $table->foreign(['car_body_id'])->references(['id'])->on('car_bodies')->onDelete('CASCADE');
        });

        Schema::table('car_colour_translations', function (Blueprint $table) {
            $table->foreign(['car_colour_id'])->references(['id'])->on('car_colours')->onDelete('CASCADE');
        });

        Schema::table('car_models', function (Blueprint $table) {
            $table->foreign(['car_brand_id'])->references(['id'])->on('car_brands')->onDelete('SET NULL');
        });

        Schema::table('car_place_translations', function (Blueprint $table) {
            $table->foreign(['car_place_id'])->references(['id'])->on('car_places')->onDelete('CASCADE');
        });

        Schema::table('car_transmission_translations', function (Blueprint $table) {
            $table->foreign(['car_transmission_id'])->references(['id'])->on('car_transmissions')->onDelete('CASCADE');
        });

        Schema::table('car_type_of_drive_translations', function (Blueprint $table) {
            $table->foreign(['car_type_of_drive_id'])->references(['id'])->on('car_type_of_drives')->onDelete('CASCADE');
        });

        /*Schema::table('categories', function (Blueprint $table) {
            $table->foreign(['one_c_parent_id'])->references(['one_c_id'])->on('categories')->onDelete('CASCADE');
        });*/

        /*Schema::table('category_translations', function (Blueprint $table) {
            $table->foreign(['category_id'])->references(['id'])->on('categories')->onDelete('CASCADE');
        });*/

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('SET NULL');
        });

        Schema::table('desired_products', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('SET NULL');
        });

        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->foreign(['permission_id'])->references(['id'])->on('permissions')->onDelete('CASCADE');
        });

        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onDelete('CASCADE');
        });

        Schema::table('order_online_payments', function (Blueprint $table) {
            $table->foreign(['order_id'])->references(['id'])->on('orders')->onDelete('SET NULL');
        });

        Schema::table('order_products', function (Blueprint $table) {
            $table->foreign(['order_id'])->references(['id'])->on('orders')->onDelete('CASCADE');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('SET NULL');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign(['payment_type_id'])->references(['id'])->on('payment_types')->onDelete('SET NULL');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('SET NULL');
        });

        Schema::table('payment_type_translations', function (Blueprint $table) {
            $table->foreign(['payment_type_id'])->references(['id'])->on('payment_types')->onDelete('CASCADE');
        });

        /*Schema::table('product_attribute_value', function (Blueprint $table) {
            $table->foreign(['attribute_value_id'])->references(['id'])->on('attribute_values')->onDelete('CASCADE');
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
        });*/

        Schema::table('product_images', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
        });

        Schema::table('product_translations', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onDelete('CASCADE');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign(['brand_id'])->references(['id'])->on('brands')->onDelete('SET NULL');
//            $table->foreign(['one_c_category_id'])->references(['one_c_id'])->on('categories')->onDelete('CASCADE');
//            $table->foreign(['category_id'])->references(['id'])->on('categories')->onDelete('SET NULL');
        });

        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->foreign(['permission_id'])->references(['id'])->on('permissions')->onDelete('CASCADE');
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onDelete('CASCADE');
        });

        Schema::table('service_category_translations', function (Blueprint $table) {
            $table->foreign(['service_category_id'])->references(['id'])->on('service_categories')->onDelete('CASCADE');
        });

        Schema::table('service_translations', function (Blueprint $table) {
            $table->foreign(['service_id'])->references(['id'])->on('services')->onDelete('CASCADE');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->foreign(['service_category_id'])->references(['id'])->on('service_categories')->onDelete('SET NULL');
        });

        Schema::table('slider_translations', function (Blueprint $table) {
            $table->foreign(['slider_id'])->references(['id'])->on('sliders')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slider_translations', function (Blueprint $table) {
            $table->dropForeign('slider_translations_slider_id_foreign');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign('services_service_category_id_foreign');
        });

        Schema::table('service_translations', function (Blueprint $table) {
            $table->dropForeign('service_translations_service_id_foreign');
        });

        Schema::table('service_category_translations', function (Blueprint $table) {
            $table->dropForeign('service_category_translations_service_category_id_foreign');
        });

        Schema::table('role_has_permissions', function (Blueprint $table) {
            $table->dropForeign('role_has_permissions_permission_id_foreign');
            $table->dropForeign('role_has_permissions_role_id_foreign');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_brand_id_foreign');
//            $table->dropForeign('products_one_c_category_id_foreign');
//            $table->dropForeign('products_category_id_foreign');
        });

        Schema::table('product_translations', function (Blueprint $table) {
            $table->dropForeign('product_translations_product_id_foreign');
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->dropForeign('product_images_product_id_foreign');
        });

        /*Schema::table('product_attribute_value', function (Blueprint $table) {
            $table->dropForeign('product_attribute_value_attribute_value_id_foreign');
            $table->dropForeign('product_attribute_value_product_id_foreign');
        });*/

        Schema::table('payment_type_translations', function (Blueprint $table) {
            $table->dropForeign('payment_type_translations_payment_type_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_payment_type_id_foreign');
            $table->dropForeign('orders_user_id_foreign');
        });

        Schema::table('order_products', function (Blueprint $table) {
            $table->dropForeign('order_products_order_id_foreign');
            $table->dropForeign('order_products_product_id_foreign');
        });

        Schema::table('order_online_payments', function (Blueprint $table) {
            $table->dropForeign('order_online_payments_order_id_foreign');
        });

        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->dropForeign('model_has_roles_role_id_foreign');
        });

        Schema::table('model_has_permissions', function (Blueprint $table) {
            $table->dropForeign('model_has_permissions_permission_id_foreign');
        });

        Schema::table('desired_products', function (Blueprint $table) {
            $table->dropForeign('desired_products_product_id_foreign');
            $table->dropForeign('desired_products_user_id_foreign');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('companies_user_id_foreign');
        });

        /*Schema::table('category_translations', function (Blueprint $table) {
            $table->dropForeign('category_translations_category_id_foreign');
        });*/

        /*Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_one_c_parent_id_foreign');
        });*/

        Schema::table('car_type_of_drive_translations', function (Blueprint $table) {
            $table->dropForeign('car_type_of_drive_translations_car_type_of_drive_id_foreign');
        });

        Schema::table('car_transmission_translations', function (Blueprint $table) {
            $table->dropForeign('car_transmission_translations_car_transmission_id_foreign');
        });

        Schema::table('car_place_translations', function (Blueprint $table) {
            $table->dropForeign('car_place_translations_car_place_id_foreign');
        });

        Schema::table('car_models', function (Blueprint $table) {
            $table->dropForeign('car_models_car_brand_id_foreign');
        });

        Schema::table('car_colour_translations', function (Blueprint $table) {
            $table->dropForeign('car_colour_translations_car_colour_id_foreign');
        });

        Schema::table('car_body_translations', function (Blueprint $table) {
            $table->dropForeign('car_body_translations_car_body_id_foreign');
        });

        Schema::table('car_ads', function (Blueprint $table) {
            $table->dropForeign('car_ads_car_place_id_foreign');
            $table->dropForeign('car_ads_car_type_of_drive_id_foreign');
            $table->dropForeign('car_ads_car_body_id_foreign');
            $table->dropForeign('car_ads_car_model_id_foreign');
            $table->dropForeign('car_ads_car_transmission_id_foreign');
            $table->dropForeign('car_ads_user_id_foreign');
            $table->dropForeign('car_ads_car_colour_id_foreign');
        });

        Schema::table('car_ad_types', function (Blueprint $table) {
            $table->dropForeign('car_ad_types_car_ad_id_foreign');
        });

        Schema::table('car_ad_phones', function (Blueprint $table) {
            $table->dropForeign('car_ad_phones_car_ad_id_foreign');
        });

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign('blog_posts_blog_category_id_foreign');
        });

        Schema::table('blog_post_translations', function (Blueprint $table) {
            $table->dropForeign('blog_post_translations_blog_post_id_foreign');
        });

        Schema::table('blog_post_tag', function (Blueprint $table) {
            $table->dropForeign('blog_post_tag_blog_post_id_foreign');
            $table->dropForeign('blog_post_tag_blog_tag_id_foreign');
        });

        Schema::table('blog_post_comments', function (Blueprint $table) {
            $table->dropForeign('blog_post_comments_blog_post_id_foreign');
            $table->dropForeign('blog_post_comments_user_id_foreign');
        });

        Schema::table('blog_category_translations', function (Blueprint $table) {
            $table->dropForeign('blog_category_translations_blog_category_id_foreign');
        });

        Schema::table('block_translations', function (Blueprint $table) {
            $table->dropForeign('block_translations_block_id_foreign');
        });

        Schema::table('block_product', function (Blueprint $table) {
            $table->dropForeign('block_product_block_id_foreign');
            $table->dropForeign('block_product_product_id_foreign');
        });

        /*Schema::table('attributes', function (Blueprint $table) {
            $table->dropForeign('attributes_attribute_group_id_foreign');
        });*/

        /*Schema::table('attribute_values', function (Blueprint $table) {
            $table->dropForeign('attribute_values_attribute_id_foreign');
        });*/

        /*Schema::table('attribute_value_translations', function (Blueprint $table) {
            $table->dropForeign('attribute_value_translations_attribute_value_id_foreign');
        });*/

        /*Schema::table('attribute_translations', function (Blueprint $table) {
            $table->dropForeign('attribute_translations_attribute_id_foreign');
        });*/

        /*Schema::table('attribute_group_translations', function (Blueprint $table) {
            $table->dropForeign('attribute_group_translations_attribute_group_id_foreign');
        });*/

        Schema::table('advertisement_products_images', function (Blueprint $table) {
            $table->dropForeign('advertisement_products_images_advertisement_product_id_foreign');
        });

        Schema::table('advertisement_products', function (Blueprint $table) {
//            $table->dropForeign('advertisement_products_category_id_foreign');
            $table->dropForeign('advertisement_products_user_id_foreign');
        });

        Schema::dropIfExists('users');

        Schema::dropIfExists('subscribers');

        Schema::dropIfExists('sliders');

        Schema::dropIfExists('slider_translations');

        Schema::dropIfExists('settings');

        Schema::dropIfExists('services');

        Schema::dropIfExists('service_translations');

        Schema::dropIfExists('service_category_translations');

        Schema::dropIfExists('service_categories');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('role_has_permissions');

        Schema::dropIfExists('products');

        Schema::dropIfExists('product_translations');

        Schema::dropIfExists('product_images');

//        Schema::dropIfExists('product_attribute_value');

        Schema::dropIfExists('personal_access_tokens');

        Schema::dropIfExists('permissions');

        Schema::dropIfExists('payment_types');

        Schema::dropIfExists('payment_type_translations');

        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('orders');

        Schema::dropIfExists('order_products');

        Schema::dropIfExists('order_online_payments');

        Schema::dropIfExists('notifications');

        Schema::dropIfExists('model_has_roles');

        Schema::dropIfExists('model_has_permissions');

//        Schema::dropIfExists('media');

        Schema::dropIfExists('logos');

        Schema::dropIfExists('jobs');

        Schema::dropIfExists('failed_jobs');

        Schema::dropIfExists('desired_products');

        Schema::dropIfExists('companies');

//        Schema::dropIfExists('category_translations');

//        Schema::dropIfExists('categories');

        Schema::dropIfExists('car_type_of_drives');

        Schema::dropIfExists('car_type_of_drive_translations');

        Schema::dropIfExists('car_transmissions');

        Schema::dropIfExists('car_transmission_translations');

        Schema::dropIfExists('car_places');

        Schema::dropIfExists('car_place_translations');

        Schema::dropIfExists('car_models');

        Schema::dropIfExists('car_colours');

        Schema::dropIfExists('car_colour_translations');

        Schema::dropIfExists('car_brands');

        Schema::dropIfExists('car_body_translations');

        Schema::dropIfExists('car_bodies');

        Schema::dropIfExists('car_ads');

        Schema::dropIfExists('car_ad_types');

        Schema::dropIfExists('car_ad_phones');

        Schema::dropIfExists('brands');

        Schema::dropIfExists('blog_tags');

        Schema::dropIfExists('blog_posts');

        Schema::dropIfExists('blog_post_translations');

        Schema::dropIfExists('blog_post_tag');

        Schema::dropIfExists('blog_post_comments');

        Schema::dropIfExists('blog_category_translations');

        Schema::dropIfExists('blog_categories');

        Schema::dropIfExists('blocks');

        Schema::dropIfExists('block_translations');

        Schema::dropIfExists('block_product');

        Schema::dropIfExists('banners');

//        Schema::dropIfExists('attributes');

//        Schema::dropIfExists('attribute_values');

//        Schema::dropIfExists('attribute_value_translations');

//        Schema::dropIfExists('attribute_translations');

//        Schema::dropIfExists('attribute_groups');

//        Schema::dropIfExists('attribute_group_translations');

        Schema::dropIfExists('advertisement_products_images');

        Schema::dropIfExists('advertisement_products');

        Schema::dropIfExists('admins');
    }
}
