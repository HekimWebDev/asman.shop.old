<?php

use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\PaymentTypeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\ServiceCategoryController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\V2\AppVersionController;
use App\Http\Controllers\Api\V2\CarAd\AttributeController as V2CarAttributeController;
use App\Http\Controllers\Api\V2\CarAd\Brand\Controller as V2CarBrandController;
use App\Http\Controllers\Api\V2\CarAd\Brand\ModelController as V2CarBrandModelController;
use App\Http\Controllers\Api\V2\CarAd\Controller as V2CarAdController;
use App\Http\Controllers\Api\V2\CarAd\LocationController as V2CarLocationController;
use App\Http\Controllers\Api\V2\CategoryController as V2CategoryController;
use App\Http\Controllers\Api\V2\CheckoutController as V2CheckoutController;
use App\Http\Controllers\Api\V2\HomeController;
use App\Http\Controllers\Api\V2\ProductController as V2ProductController;
use App\Http\Controllers\Api\V2\SearchController as V2SearchController;
use App\Http\Controllers\Api\V2\UserController as V2UserController;
use App\Http\Controllers\Api\V3\AttributeController;
use App\Http\Controllers\Api\V3\BlogPostController as V3BlogPostController;
use App\Http\Controllers\Api\V3\BrandController as V3BrandController;
use App\Http\Controllers\Api\V3\CarAd\BodyController as V3CarBodyController;
use App\Http\Controllers\Api\V3\CarAd\Brand\Controller as V3CarBrandController;
use App\Http\Controllers\Api\V3\CarAd\Brand\ModelController as V3CarBrandModelController;
use App\Http\Controllers\Api\V3\CarAd\ColourController as V3CarColourController;
use App\Http\Controllers\Api\V3\CarAd\PlaceController as V3CarPlaceController;
use App\Http\Controllers\Api\V3\CarAd\TransmissionController as V3CarTransmissionController;
use App\Http\Controllers\Api\V3\CarAd\TypeOfDriveController as V3CarTypeOfDriveController;
use App\Http\Controllers\Api\V3\CategoryController as V3CategoryController;
use App\Http\Controllers\Api\V3\ProductController as V3ProductController;
use App\Http\Controllers\Api\V3\SliderController as V3SliderController;
use App\Http\Controllers\Api\V3\SubscribeController as V3SubscribeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('me')->group(function () {
        Route::get('/', [UserController::class, 'me']);
        Route::get('orders', [UserController::class, 'orders']);
        Route::get('car-ads', [UserController::class, 'carAds']);
        Route::post('update', [UserController::class, 'update']);
        Route::post('password/change', [UserController::class, 'changePassword']);
    });

    Route::post('checkout', [CheckoutController::class, 'store']);
    Route::post('logout', [LoginController::class, 'logout']);
});

Route::prefix('blog')->group(function () {
    Route::prefix('posts')->group(function () {
        Route::get('/', [BlogPostController::class, 'index']);
        Route::get('/{slug}', [BlogPostController::class, 'show']);
    });
});

Route::prefix('brands')->group(function () {
    Route::get('/', [BrandController::class, 'index']);
    Route::get('/{brand:slug}', [BrandController::class, 'products']);
    Route::get('/{brand:slug}/categories', [BrandController::class, 'categories']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/main-categories', [CategoryController::class, 'mainCategories']);
    Route::get('/{slug}', [CategoryController::class, 'products']);
    Route::get('/{slug}/brands', [CategoryController::class, 'brands']);
});

Route::get('payment-types', [PaymentTypeController::class, 'index']);

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{slug}', [ProductController::class, 'show']);
    Route::get('/{slug}/attributes', [ProductController::class, 'attributes']);
});

Route::get('search', SearchController::class);

Route::prefix('services')->group(function () {
    Route::get('/', [ServiceCategoryController::class, 'index']);
    Route::get('/{slug}', [ServiceCategoryController::class, 'show']);
    Route::get('{serviceCategorySlug}/{serviceSlug}', [ServiceCategoryController::class, 'showService']);
});

Route::get('sliders', [SliderController::class, 'index']);

Route::post('login', [LoginController::class, 'login']);
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [ResetPasswordController::class, 'reset']);
Route::post('register', [RegisterController::class, 'register']);

/**
 * API for application
 */
Route::prefix('v2')->group(function () {
    Route::prefix('ads')->group(function () {
        Route::get('attributes', [V2CarAttributeController::class, 'index']);
        Route::get('locations', [V2CarLocationController::class, 'index']);

        Route::prefix('brands')->group(function () {
            Route::get('/', [V2CarBrandController::class, 'index']);
            Route::get('{id}/models', [V2CarBrandModelController::class, 'index']);
        });

        Route::post('{ad:id}/images/store', [V2CarAdController::class, 'storeImage']);
        Route::post('{ad:id}/images/order', [V2CarAdController::class, 'orderImage']);
    });

    Route::get('about-us-information', \App\Http\Controllers\Api\V2\AboutUsSettingController::class);
    Route::get('app-version/check', AppVersionController::class);
    Route::get('attributes', [\App\Http\Controllers\Api\V2\AttributeController::class, 'index']);
    Route::get('contact-information', \App\Http\Controllers\Api\V2\ContactSettingController::class);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::prefix('checkout')->group(function () {
            Route::post('/', [V2CheckoutController::class, 'store']);
            Route::post('save', [V2CheckoutController::class, 'save']);
        });

        Route::prefix('me')->group(function () {
            Route::get('/', [V2UserController::class, 'me']);

            Route::prefix('ads')->group(function () {
                Route::get('/', [V2UserController::class, 'ads']);
                Route::post('{carAd:id}/boost', [App\Http\Controllers\Api\V2\CarAd\Controller::class, 'boost']);
                Route::post('{carAd:id}/premium/store', [App\Http\Controllers\Api\V2\CarAd\Controller::class, 'storePremium']);
            });

            Route::get('orders', [V2UserController::class, 'orders']);
            Route::post('update', [V2UserController::class, 'update']);
            Route::post('password/change', [V2UserController::class, 'changePassword']);
        });

        Route::post('logout', [LoginController::class, 'logout']);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [V2CategoryController::class, 'index']);
        Route::get('/{id}', [V2CategoryController::class, 'show']);
        Route::get('/{id}/attributes', [V2CategoryController::class, 'attributes']);
        Route::get('/{id}/brands', [V2CategoryController::class, 'brands']);
        Route::get('/{id}/products', [V2CategoryController::class, 'products']);
    });

    Route::get('home', [HomeController::class, 'index']);

    Route::prefix('products')->group(function () {
        Route::get('/', [V2ProductController::class, 'index']);
        Route::get('/{id}', [V2ProductController::class, 'show']);
    });

    Route::prefix('search')->group(function () {
        Route::get('/', [V2SearchController::class, 'index']);
        Route::get('attributes', [V2SearchController::class, 'attributes']);
    });

    Route::get('sliders', [SliderController::class, 'index']);

    Route::apiResource('ads', V2CarAdController::class);

    Route::post('cart/products/check', [V2ProductController::class, 'cartProductCheck']);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);
});

/**
 * API V3
 */
Route::prefix('v3')->group(function () {
    Route::get('attributes', [AttributeController::class, 'index']);

    Route::prefix('car-ads')->group(function () {
        Route::prefix('brands')->group(function () {
            Route::get('/', [V3CarBrandController::class, 'index']);
            Route::get('{id}/models', [V3CarBrandModelController::class, 'index']);
        });

        Route::get('bodies', [V3CarBodyController::class, 'index']);
        Route::get('colours', [V3CarColourController::class, 'index']);
        Route::prefix('places')->group(function () {
            Route::get('/', [V3CarPlaceController::class, 'index']);
            Route::get('{id}/children', [V3CarPlaceController::class, 'children']);
        });
        Route::get('transmissions', [V3CarTransmissionController::class, 'index']);
        Route::get('type-of-drives', [V3CarTypeOfDriveController::class, 'index']);

        Route::post('{ad:id}/images/order', [App\Http\Controllers\Api\V3\CarAd\Controller::class, 'orderImage']);
        Route::post('{ad:id}/images/store', [App\Http\Controllers\Api\V3\CarAd\Controller::class, 'storeImage']);
        Route::post('{ad:id}/images/delete', [App\Http\Controllers\Api\V3\CarAd\Controller::class, 'deleteImage']);
    });

    Route::prefix('brands')->group(function () {
        Route::get('/', [V3BrandController::class, 'index']);
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [V3CategoryController::class, 'index']);
    });

    Route::get('contact-information', \App\Http\Controllers\Api\V3\ContactSettingController::class);
    Route::get('about-us-information', \App\Http\Controllers\Api\V3\AboutUsSettingController::class);

    Route::prefix('posts')->group(function () {
        Route::get('/', [V3BlogPostController::class, 'index']);
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [V3ProductController::class, 'index']);
        Route::get('/{id}', [V3ProductController::class, 'show']);
    });

    Route::get('sliders', [V3SliderController::class, 'index']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::prefix('me')->group(function () {
            Route::prefix('car-ads')->group(function () {
                Route::post('{carAd:id}/boost', [App\Http\Controllers\Api\V3\CarAd\Controller::class, 'boost']);
                Route::post('{carAd:id}/premium/store', [App\Http\Controllers\Api\V3\CarAd\Controller::class, 'storePremium']);
            });
        });
    });

    Route::apiResource('car-ads', App\Http\Controllers\Api\V3\CarAd\Controller::class);

    Route::post('subscribe', [V3SubscribeController::class, 'store']);
});
