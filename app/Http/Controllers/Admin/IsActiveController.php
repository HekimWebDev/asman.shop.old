<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IsActiveController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $model = "App\\Models\\" . $request->model;
        $model = $model::findOrFail($request->id);
        $model->is_active = $request->is_active;
        $model->save();
    }
}