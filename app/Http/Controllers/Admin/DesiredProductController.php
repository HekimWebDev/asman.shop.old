<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesiredProduct;
use Illuminate\Http\Request;

class DesiredProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desiredProducts = DesiredProduct::latest()
            ->with('product.translation')
            ->get();

        // dd($desiredProducts);

        return view('admin.desired-products.index', compact('desiredProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DesiredProduct  $desiredProduct
     * @return \Illuminate\Http\Response
     */
    public function show(DesiredProduct $desiredProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DesiredProduct  $desiredProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(DesiredProduct $desiredProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DesiredProduct  $desiredProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DesiredProduct $desiredProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DesiredProduct  $desiredProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(DesiredProduct $desiredProduct)
    {
        //
    }
}
