<?php

namespace App\Http\Controllers\Api\V3\CarAd;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Resources\Api\V3\CarAdResource;
use App\Models\Admin;
use App\Models\CarAd;
use App\Models\CarAdType;
use App\Notifications\NewCarAdPremiumRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\MediaCannotBeDeleted;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $carAds = CarAd::when(
            $request->filled('can_credit'),
            fn($query) => $query->where('can_credit', $request->boolean('can_credit'))
        )
            ->when(
                $request->filled('can_exchange'),
                fn($query) => $query->where('can_exchange', $request->boolean('can_exchange'))
            )
            ->when(
                $request->filled('min_price'),
                fn($query) => $query->where('price', '>=', $request->min_price)
            )
            ->when(
                $request->filled('max_price'),
                fn($query) => $query->where('price', '<=', $request->max_price)
            )
            ->when(
                $request->filled('min_year'),
                fn($query) => $query->where('year', '>=', $request->min_year)
            )
            ->when(
                $request->filled('max_year'),
                fn($query) => $query->where('year', '<=', $request->max_year)
            )
            ->when(
                $request->filled('car_brand_id'),
                fn($query) => $query->whereHas(
                    'carModel',
                    fn($query) => $query->whereHas(
                        'carBrand',
                        fn($query) => $query->where('id', $request->car_brand_id)
                    )
                )
            )
            ->when(
                $request->filled('car_model_id'),
                fn($query) => $query->where('car_model_id', $request->car_model_id)
            )
            ->when(
                $request->filled('sort'),
                function ($query) use ($request) {
                    $sort = $request->sort;
                    $sortMethod = 'asc';
                    if ($sort[0] === '-') {
                        $sort = Str::substr($sort, 1);
                        $sortMethod = 'desc';
                    }

                    return $query->orderBy($sort, $sortMethod);
                }
            )
            ->skip($request->offset)
            ->take($request->limit ?? PHP_INT_MAX)
            ->with([
                'carBody' => fn($query) => $query->with('translations'),
                'carColour' => fn($query) => $query->with('translations'),
                'carModel' => fn($query) => $query->with('carBrand'),
                'carPlace' => fn($query) => $query->with('translations'),
                'carTransmission' => fn($query) => $query->with('translations'),
                'carTypeOfDrive' => fn($query) => $query->with('translations'),
                'media'
            ])
            ->isPublished()
            ->orderBy('published_at', 'desc')
            ->get()
            ->sortByDesc('is_premium');

        return CarAdResource::collection($carAds)->additional([
            'min_price' => $carAds->min('price'),
            'max_price' => $carAds->max('price'),
            'min_year' => $carAds->min('year'),
            'max_year' => $carAds->max('year'),
            'result' => $carAds->count()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        set_time_limit(0);

        $validator = Validator::make($request->all(), [
            'car_model_id' => 'required|exists:car_models,id',
            'year' => 'required|integer|min:1980|max:' . date('Y'),
            'car_body_id' => 'required|exists:car_bodies,id',
            'mileage' => 'required|integer|min:0|max:900000',
            'motor' => 'required|between:0.5,5.0',
            'car_transmission_id' => 'required|exists:car_transmissions,id',
            'car_type_of_drive_id' => 'required|exists:car_type_of_drives,id',
            'car_colour_id' => 'required|exists:car_colours,id',
            // 'vin_code' => 'required',
            'price' => 'required',
            'car_place_id' => 'required|exists:car_places,id',
            'can_credit' => 'required|boolean',
            'can_exchange' => 'required|boolean',
            'additional' => 'nullable',
            'can_comment' => 'required|boolean',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:15360',
            'phone' => 'required|numeric|digits:8'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        $carAd = $request->user()->carAds()->create($request->post());
        $carAd->carAdPhones()->create([
            'phone' => $request->phone
        ]);

        if ($request->hasFile('images')) {
            $carAd->addMultipleMediaFromRequest(['images'])
                ->each(function ($image) {
                    $image->toMediaCollection();
                });
        }

        return response([
            'message' => 'Your ad created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return CarAdResource
     */
    public function show($id): CarAdResource
    {
        $carAd = CarAd::with([
            'carBody' => fn($query) => $query->with('translations'),
            'carColour' => fn($query) => $query->with('translations'),
            'carModel' => fn($query) => $query->with('carBrand'),
            'carPlace' => fn($query) => $query->with('translations'),
            'carTransmission' => fn($query) => $query->with('translations'),
            'carTypeOfDrive' => fn($query) => $query->with('translations'),
            'media'
        ])->findOrFail($id);

        return new CarAdResource($carAd);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function update(Request $request, $id): Response
    {
        $carAd = CarAd::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'car_model_id' => 'required|exists:car_models,id',
            'year' => 'required|integer|min:1980|max:' . date('Y'),
            'car_body_id' => 'required|exists:car_bodies,id',
            'mileage' => 'required|integer|min:0|max:900000',
            'motor' => 'required|between:0.5,5.0',
            'car_transmission_id' => 'required|exists:car_transmissions,id',
            'car_type_of_drive_id' => 'required|exists:car_type_of_drives,id',
            'car_colour_id' => 'required|exists:car_colours,id',
            // 'vin_code' => 'required',
            'price' => 'required',
            'car_place_id' => 'required|exists:car_places,id',
            'can_credit' => 'required|boolean',
            'can_exchange' => 'required|boolean',
            'additional' => 'nullable',
            'can_comment' => 'required|boolean',
            // 'images' => 'required',
            // 'images.*' => 'required|image'
            'phone' => 'required|numeric|digits:8'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        $carAd->update($request->post());
        $carAd->carAdPhones()->first()->update([
            'phone' => $request->phone
        ]);

        // if ($request->hasFile('images')) {
        //     $carAd->addMultipleMediaFromRequest(['images'])
        //         ->each(function ($image) {
        //             $image->toMediaCollection('images');
        //         });
        // }

        return response([
            'message' => 'Your ad updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id): Response
    {
        $carAd = CarAd::findOrFail($id)->delete();

        return response([
            'message' => 'Your ad deleted successfully'
        ]);
    }

    /**
     * @param CarAd $ad
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    function storeImage(CarAd $ad, Request $request): Response|Application|ResponseFactory
    {
        set_time_limit(0);

        $validator = Validator::make($request->all(), [
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:15360',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
                'success' => false
            ], 400);
        }

        if ($request->hasFile('images')) {
            $ad->addMultipleMediaFromRequest(['images'])
                ->each(function ($image) {
                    $image
                        ->toMediaCollection();
                });
        } else {
            return response([
                'message' => 'Images not found',
                'success' => false
            ]);
        }

        return response([
            'message' => 'Images upload successfully',
            'success' => true
        ]);
    }

    /**
     * @param CarAd $ad
     * @param Request $request
     * @return Application|ResponseFactory|Response
     * @throws MediaCannotBeDeleted
     */
    function deleteImage(CarAd $ad, Request $request): Response|Application|ResponseFactory
    {
        $validator = Validator::make($request->all(), [
            'image_id' => 'required|exists:media,id',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error'
            ], 400);
        }

        $media = Media::whereModelType('App\Models\CarAd')
            ->whereModelId($ad->id)
            ->find($request->input('image_id'));

        if ($media) {
            $ad->deleteMedia($request->input('image_id'));
        } else {
            return response([
                'message' => 'Image not found',
                'success' => false
            ]);
        }

        return response([
            'message' => 'Image deleted successfully',
            'success' => true
        ]);
    }

    /**
     * @param CarAd $ad
     * @param Request $request
     * @return Response|Application|ResponseFactory
     */
    function orderImage(CarAd $ad, Request $request): Response|Application|ResponseFactory
    {
        $validator = Validator::make($request->all(), [
            'images_id' => 'required|array',
            'images_id.*' => 'exists:media,id',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => [
                    'tk' => 'Barlamak säwligi',
                    'en' => 'Validation error',
                    'ru' => 'Ошибка проверки'
                ],
                'success' => false
            ], 400);
        }

        foreach ($request->input('images_id') as $key => $image_id) {
            $media = Media::find($image_id)->update([
                'order_column' => $key + 1
            ]);
        }

        return response([
            'message' => [
                'tk' => 'Suratlar üstünlikli tertipleşdirildi',
                'en' => 'Images reordered successfully',
                'ru' => 'Изображения успешно переупорядочены'
            ],
            'success' => true
        ]);
    }

    public function boost(CarAd $carAd)
    {
        if (isset($carAd->published_at) && $carAd->published_at->diffInDays(now(), false) < 3) {
            $canBoostableDay = 3 - now()->diffInDays($carAd->published_at);

            $boostableTime['tk'] = new Carbon(now());
            $boostableTime['tk']->setLocale('tk');
            $boostableTime['tk'] = $boostableTime['tk']->addDays($canBoostableDay)->diffForHumans();

            $boostableTime['en'] = new Carbon(now());
            $boostableTime['en']->setLocale('en');
            $boostableTime['en'] = $boostableTime['en']->addDays($canBoostableDay)->diffForHumans();

            $boostableTime['ru'] = new Carbon(now());
            $boostableTime['ru']->setLocale('ru');
            $boostableTime['ru'] = $boostableTime['ru']->addDays($canBoostableDay)->diffForHumans();

            return response([
                'message' => [
                    'tk' => 'Bagyşlaň siz ýene ' . $boostableTime['tk'] . ' mahabatyňyzy ýokary galdyryp bilersiňiz',
                    'en' => 'Sorry you can boost your ad in another ' . $boostableTime['en'],
                    'ru' => 'Извините, но вы можете повысить свою рекламу еще ' . $boostableTime['ru']
                ],
                'success' => false
            ]);
        }

        $carAd->update([
            'published_at' => now()
        ]);

        return response([
            'message' => [
                'tk' => 'Mahabatyňyz üstünlikli ýokary galdyryldy',
                'en' => 'Your ad was successfully boosted',
                'ru' => 'Ваше объявление было успешно повышено'
            ],
            'success' => true
        ]);
    }

    /**
     * @param CarAd $carAd
     * @return Response|Application|ResponseFactory
     */
    public function storePremium(CarAd $carAd): Response|Application|ResponseFactory
    {
        $carAd->load([
            'carAdType' => fn($query) => $query->latest()
        ]);

        if ($carAd->carAdType()->exists()) {
            if (!$carAd->carAdType->is_active) {
                return response([
                    'message' => [
                        'tk' => 'Mahabatyňyz üçin öň ugradan arzaňyz bar',
                        'en' => 'You already have an application submitted for your ad',
                        'ru' => 'У вас уже есть заявка на ваше объявление'
                    ],
                    'success' => false
                ]);
            }

            if (now()->diffInSeconds($carAd->carAdType->expire_date, false) > 0) {
                return response([
                    'message' => [
                        'tk' => 'Işjeň premium paketiňiz bar',
                        'en' => 'You have an active premium package',
                        'ru' => 'У вас есть активный премиум-пакет'
                    ],
                    'success' => false
                ]);
            }
        }

        $carAdType = $carAd->carAdType()->create();

        $admins = Admin::all();
        $admins->each(
            fn($admin) => $admin->notify(new NewCarAdPremiumRequest($carAdType))
        );

        return response([
            'message' => [
                'tk' => 'Premium bildiriş üçin arzaňyz üstünlikli ugradyldy',
                'en' => 'Your application for premium advertising has been successfully submitted',
                'ru' => 'Ваша заявка на премиальную рекламу успешно отправлена'
            ],
            'success' => true
        ]);
    }
}
