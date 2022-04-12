<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeGroupController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\Car\AdController as CarAdController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\DesiredProductController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\IsActiveController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OneCController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderProductController;
use App\Http\Controllers\Admin\PaymentTypeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\User\OrderController as UserOrderController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\ValueController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::prefix('order')->group(function () {
        Route::resources([
            'orders' => OrderController::class,
            'orders.products' => OrderProductController::class,
            'payment-types' => PaymentTypeController::class,
        ]);
    });

    Route::resources([
        'admins' => AdminController::class,
        'users' => UserController::class,
        'users.orders' => UserOrderController::class,
    ]);

    Route::prefix('catalog')->group(function () {
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('position', [CategoryController::class, 'position'])->name('position');
            Route::post('position/update', [CategoryController::class, 'updatePosition'])->name('position.update');
        });

        Route::prefix('attributes')->name('attributes.')->group(function () {
            Route::get('attributes/select', [AttributeController::class, 'selectAttribute'])->name('select');
            Route::get('attribute-values/select', [AttributeController::class, 'selectAttributeValue'])->name('values.select');
        });

        Route::prefix('products')->name('products.')->group(function () {
            Route::get('trashed', [ProductController::class, 'trash'])->name('trash');
            Route::post('{id}/restore', [ProductController::class, 'restore'])->name('restore');
            Route::post('restore-all', [ProductController::class, 'restoreAll'])->name('restore-all');
        });

        Route::resources([
            'attribute-groups' => AttributeGroupController::class,
            'attributes' => AttributeController::class,
            'attributes.values' => AttributeValueController::class,
            'attribute-values' => ValueController::class,
            'brands' => BrandController::class,
            'categories' => CategoryController::class,
            'products' => ProductController::class,
        ]);
    });

    Route::prefix('service')->name('service.')->group(function () {
        Route::resources([
            'categories' => ServiceCategoryController::class,
            'services' => ServiceController::class,
        ]);
    });

    Route::prefix('blog')->name('blog.')->group(function () {
        Route::resources([
            'categories' => BlogCategoryController::class,
            'posts' => BlogPostController::class,
            'tags' => BlogTagController::class,
            'comments' => BlogCommentController::class,
        ]);
    });

    Route::prefix('design')->group(function () {
        Route::resources([
            'sliders' => SliderController::class,
            'banners' => BannerController::class,
            'logos' => LogoController::class,
        ]);
    });

    Route::prefix('modules')->group(function () {
        Route::resources([
            'subscribers' => SubscriberController::class,
            'blocks' => BlockController::class,
            'desired-products' => DesiredProductController::class,
        ]);
    });

    Route::prefix('ad')->group(function () {
        Route::prefix('ads')->name('ads.')->group(function () {
            Route::prefix('settings')
                ->name('settings.')
                ->controller(\App\Http\Controllers\Admin\Car\SettingController::class)
                ->group(function () {
                    Route::get('/', 'edit')->name('edit');
                    Route::put('/', 'update')->name('update');
                });
        });

        Route::resources([
            'ads' => CarAdController::class,
            'ads.types' => \App\Http\Controllers\Admin\Car\TypeController::class
        ]);
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::prefix('about-us')->name('about_us.')
            ->controller(\App\Http\Controllers\Admin\Setting\AboutUsController::class)
            ->group(function () {
                Route::get('/', 'edit')->name('edit');
                Route::put('/', 'update')->name('update');
            });

        Route::prefix('contact')->name('contact.')
            ->controller(\App\Http\Controllers\Admin\Setting\ContactController::class)
            ->group(function () {
                Route::get('/', 'edit')->name('edit');
                Route::put('/', 'update')->name('update');
            });
    });

    Route::get('1c', OneCController::class)->name('1c');
    Route::get('products/export', [ProductController::class, 'export']);
    Route::get('checkout', CheckoutController::class);
    Route::get('categories/import', [CategoryController::class, 'import'])->name('categories.import');
    Route::post('categories/import', [CategoryController::class, 'importPost'])->name('categories.import.post');
    Route::get('attributes/import', [AttributeController::class, 'import'])->name('attributes.import');
    Route::post('attributes/import', [AttributeController::class, 'importPost'])->name('attributes.import.post');
    Route::get('products/attributes/import', [ProductController::class, 'attributesImport'])->name('products.attributes.import');
    Route::post('products/attributes/import', [ProductController::class, 'attributesImportPost'])->name('products.attributes.import.post');
    Route::post('status', StatusController::class)->name('status');
    Route::post('is-active', IsActiveController::class)->name('is-active');
    Route::post('product/image', [ProductController::class, 'deleteImage'])->name('product.image');
    Route::post('orders/status', [OrderController::class, 'status'])->name('orders.status.post');
});

Route::get('/lang/{locale}', function ($lang) {
    if (in_array($lang, config('translatable.locales'))) {
        session()->put('locale', $lang);
    }
    return redirect()->back();
})->name('locale');

Route::group(['namespace' => 'App\\Http\\Controllers\\Admin\\Auth'], function () {
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login_page');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});
