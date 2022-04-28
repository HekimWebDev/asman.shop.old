<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    /*$cat = \App\Models\Category::with('descendants')->get();

    $jsCat = $cat->map(function ($category) {
        return [
            'id' => $category->id,
            'title' => $category->name,
            'subs' => $category->descendants->map(function ($category) {
                return [
                    'id' => $category->id,
                    'title' => $category->name,
                ];
            })
        ];
    });*/

    return view('welcome', compact('cat', 'jsCat'));
});
