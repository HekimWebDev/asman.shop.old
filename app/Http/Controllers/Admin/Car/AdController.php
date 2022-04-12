<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Models\CarAd;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $carAds = CarAd::with([
            'user',
            'carModel' => fn($query) => $query->with('carBrand'),
        ])
            ->withExists('carAdType')
            ->latest()
            ->get();

        return view('admin.car-ads.index', compact('carAds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id, Request $request)
    {
        if ($request->get('notification_id')) {
            $userUnreadNotification = auth()->user()
                ->unreadNotifications
                ->where('id', $request->get('notification_id'))
                ->first();

            $userUnreadNotification?->markAsRead();
        }

        $carAd = CarAd::with([
            'user',
            'carModel' => fn($query) => $query->with('carBrand'),
            'carBody' => fn($query) => $query->with('translations'),
            'carTransmission' => fn($query) => $query->with('translations'),
            'carTypeOfDrive' => fn($query) => $query->with('translations'),
            'carColour' => fn($query) => $query->with('translations'),
            'carPlace' => fn($query) => $query->with([
                'translations',
                'parent.translations'
            ]),
            'media' => fn($query) => $query->orderBy('order_column'),
            'carAdPhones',
            'carAdType' => fn($query) => $query->latest()
        ])->findOrFail($id);

        return view('admin.car-ads.show', compact('carAd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CarAd $carAd
     * @return Response
     */
    public function edit(CarAd $carAd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CarAd $carAd
     * @return Response
     */
    public function update(Request $request, CarAd $carAd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        CarAd::findOrFail($id)->delete();

        return back();
    }
}
