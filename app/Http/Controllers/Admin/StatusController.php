<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $model = "App\\Models\\" . $request->model;
        $model = $model::findOrFail($request->id);
        $model->status = $request->status;
        $model->save();
    }
}
