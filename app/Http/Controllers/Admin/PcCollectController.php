<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PcCollect;
use Illuminate\Http\Request;

class PcCollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('translation', 'childs', 'pcCollect')->get();
        return view('admin.pc-collect.index', compact('categories'));
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
        PcCollect::truncate();
        if ($request->category_id) {
            foreach ($request->category_id as $category_id) {
                PcCollect::create([
                    'category_id' => $category_id
                ]);
            }
        }

        return redirect()->route('admin.pc-collects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PcCollect  $pcCollect
     * @return \Illuminate\Http\Response
     */
    public function show(PcCollect $pcCollect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PcCollect  $pcCollect
     * @return \Illuminate\Http\Response
     */
    public function edit(PcCollect $pcCollect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PcCollect  $pcCollect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PcCollect $pcCollect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PcCollect  $pcCollect
     * @return \Illuminate\Http\Response
     */
    public function destroy(PcCollect $pcCollect)
    {
        //
    }
}
