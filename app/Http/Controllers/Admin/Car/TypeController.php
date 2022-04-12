<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\StoreTypeRequest;
use App\Http\Requests\Car\UpdateTypeRequest;
use App\Models\CarAd;
use App\Models\CarAdType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CarAd $ad
     * @return Application|Factory|View
     */
    public function index(CarAd $ad): View|Factory|Application
    {
        return view('admin.car-ads.types.index', compact('ad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CarAd $ad
     * @return Application|Factory|View
     */
    public function create(CarAd $ad): View|Factory|Application
    {
        return view('admin.car-ads.types.create', compact('ad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTypeRequest $request
     * @param CarAd $ad
     * @return RedirectResponse
     */
    public function store(StoreTypeRequest $request, CarAd $ad): RedirectResponse
    {
        $ad->carAdType()->create($request->only('is_active', 'expire_date'));

        return redirect()->route('admin.ads.types.index', $ad->id);
    }

    /**
     * Display the specified resource.
     *
     * @param CarAd $carAd
     * @param CarAdType $carAdType
     * @return Response
     */
    public function show(CarAd $carAd, CarAdType $carAdType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarAd $ad
     * @param CarAdType $type
     * @return Application|Factory|View
     */
    public function edit(CarAd $ad, CarAdType $type)
    {
        return view('admin.car-ads.types.edit', compact('ad', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CarAd $ad
     * @param CarAdType $type
     * @return RedirectResponse
     */
    public function update(UpdateTypeRequest $request, CarAd $ad, CarAdType $type): RedirectResponse
    {
        $type->update([
            'is_active' => $request->boolean('is_active'),
            'expire_date' => $request->get('expire_date')
        ]);

        return redirect()->route('admin.ads.show', $ad->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CarAd $carAd
     * @param CarAdType $carAdType
     * @return Response
     */
    public function destroy(CarAd $carAd, CarAdType $carAdType)
    {
        //
    }
}
