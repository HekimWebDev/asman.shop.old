<?php

namespace App\Http\Controllers\Api\V2\CarAd;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Resources\Api\V2\CarAdResource;
use App\Models\Admin;
use App\Models\CarAd;
use App\Notifications\NewCarAdPremiumRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\Pure;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Validator;

class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $ads = CarAd::when(
            $request->filled('search'),
            fn($query) => $query->where('mileage', 'LIKE', '%' . $request->search . '%')
                ->orWhere('motor', 'LIKE', '%' . $request->search . '%')
                ->orWhere('vin_code', 'LIKE', '%' . $request->search . '%')
                ->orWhere('price', 'LIKE', '%' . $request->search . '%')
                ->orWhere('vin_code', 'LIKE', '%' . $request->search . '%')
                ->orWhere('additional', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas(
                    'carModel',
                    fn($query) => $query->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhereHas(
                            'carBrand',
                            fn($query) => $query->where('name', 'LIKE', '%' . $request->search . '%')
                        )
                )
                ->orWhereHas(
                    'carTypeOfDrive',
                    fn($query) => $query->whereTranslationLike('name', '%' . $request->search . '%')
                )
                ->orWhereHas(
                    'carTransmission',
                    fn($query) => $query->whereTranslationLike('name', '%' . $request->search . '%')
                )
                ->orWhereHas(
                    'carColour',
                    fn($query) => $query->whereTranslationLike('name', '%' . $request->search . '%')
                )
        )
            ->isPublished()
            ->orderBy('published_at', 'desc');

        if ($request->page || $request->per_page) {
            $per_page = $request->per_page ?? 10;
            $ads = $ads->paginate($per_page);

            return CarAdResource::collection($ads)->appends([
                'per_page' => $per_page
            ]);
        } else {
            $ads = $ads->get();
        }

        return CarAdResource::collection($ads);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'car_brand' => 'required|exists:car_brands,id',
            'car_model' => 'required|exists:car_models,id',
            'year' => 'required|integer|min:1980|max:' . date('Y'),
            'body' => 'required|exists:car_bodies,id',
            'mileage' => 'required|integer|min:0|max:900000',
            'motor' => 'required|between:0.5,5.0',
            'transmission' => 'required|exists:car_transmissions,id',
            'type_of_drive' => 'required|exists:car_type_of_drives,id',
            'color' => 'required|exists:car_colours,id',
            'price' => 'required',
            'location' => 'required|exists:car_places,id',
            'can_credit' => 'required',
            'can_exchange' => 'required',
            'additional' => 'nullable',
            'can_comment' => 'nullable',
            'phone' => 'required|numeric|digits:8'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        $ad = $request->user()->carAds()->create([
            'car_model_id' => $request->input('car_model'),
            'year' => $request->input('year'),
            'car_body_id' => $request->input('body'),
            'mileage' => $request->input('mileage'),
            'motor' => $request->input('motor'),
            'car_transmission_id' => $request->input('transmission'),
            'car_type_of_drive_id' => $request->input('type_of_drive'),
            'car_colour_id' => $request->input('color'),
            'price' => $request->input('price'),
            'car_place_id' => $request->input('location'),
            'can_credit' => $request->boolean('can_credit'),
            'can_exchange' => $request->boolean('can_exchange'),
            'additional' => $request->input('additional'),
            'can_comment' => $request->boolean('can_comment'),
        ]);
        $ad->carAdPhones()->create([
            'phone' => $request->input('phone')
        ]);

        return response([
            'message' => [
                'tk' => 'Mahabatyňyz üstünlikli döredildi',
                'en' => 'Your ad created successfully',
                'ru' => 'Ваше объявление успешно создано'
            ],
            'data' => [
                'ads_id' => $ad->id
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param CarAd $ad
     * @return CarAdResource
     */
    #[Pure] public function show(CarAd $ad): CarAdResource
    {
        return new CarAdResource($ad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CarAd $ad
     * @return Response
     */
    public function update(CarAd $ad, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'car_brand' => 'required|exists:car_brands,id',
            'car_model' => 'required|exists:car_models,id',
            'year' => 'required|integer|min:1980|max:' . date('Y'),
            'body' => 'required|exists:car_bodies,id',
            'mileage' => 'required|integer|min:0|max:900000',
            'motor' => 'required|between:0.5,5.0',
            'transmission' => 'required|exists:car_transmissions,id',
            'type_of_drive' => 'required|exists:car_type_of_drives,id',
            'color' => 'required|exists:car_colours,id',
            'price' => 'required',
            'location' => 'required|exists:car_places,id',
            'can_credit' => 'required',
            'can_exchange' => 'required',
            'additional' => 'nullable',
            'can_comment' => 'nullable',
            'phone' => 'required|numeric|digits:8'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation error',
            ], 400);
        }

        $ad->update([
            'car_model_id' => $request->input('car_model'),
            'year' => $request->input('year'),
            'car_body_id' => $request->input('body'),
            'mileage' => $request->input('mileage'),
            'motor' => $request->input('motor'),
            'car_transmission_id' => $request->input('transmission'),
            'car_type_of_drive_id' => $request->input('type_of_drive'),
            'car_colour_id' => $request->input('color'),
            'price' => $request->input('price'),
            'car_place_id' => $request->input('location'),
            'can_credit' => $request->boolean('can_credit'),
            'can_exchange' => $request->boolean('can_exchange'),
            'additional' => $request->input('additional'),
            'can_comment' => $request->boolean('can_comment'),
            'is_active' => false
        ]);

        $ad->carAdPhones()->first()->update([
            'phone' => $request->input('phone')
        ]);

        return response([
            'message' => [
                'tk' => 'Mahabatyňyz üstünlikli täzelendi',
                'en' => 'Your ad updated successfully',
                'ru' => 'Ваше объявление успешно изменено'
            ],
            'data' => [
                'ads_id' => $ad->id
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CarAd $ad
     * @return Response
     */
    public function destroy(CarAd $ad): Response
    {
        $ad->delete();

        return response([
            'message' => [
                'tk' => 'Mahabatyňyz üstünlikli pozuldy',
                'en' => 'Your ad deleted successfully',
                'ru' => 'Ваше объявление успешно удалено'
            ],
            'status' => true
        ]);
    }

    /**
     * @param CarAd $ad
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    function storeImage(CarAd $ad, Request $request): Response|Application|ResponseFactory
    {
        set_time_limit(0);

        $validator = Validator::make($request->all(), [
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:15360',
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

        if ($request->hasFile('images')) {
            $ad->clearMediaCollection();

            $ad->addMultipleMediaFromRequest(['images'])
                ->each(function ($image) {
                    $image->toMediaCollection();
                });
        } else {
            return response([
                'message' => [
                    'tk' => 'Suratlar tapylmady',
                    'en' => 'Images not found',
                    'ru' => 'Изображения не найдены'
                ],
                'success' => false
            ]);
        }

        return response([
            'message' => [
                'tk' => 'Suratlar üstünlikli ýüklendi',
                'en' => 'Images uploaded successfully',
                'ru' => 'Изображения успешно загружены'
            ],
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
        if (isset($carAd->published_at) && $carAd->published_at->diffInDays(now(), false) <= 3) {
            $boostableTime['tk'] = new Carbon(now());
            $boostableTime['tk']->setLocale('tk');
            $boostableTime['tk'] = $boostableTime['tk']->addDays(3)->diffForHumans($carAd->published_at);

            $boostableTime['en'] = new Carbon(now());
            $boostableTime['en']->setLocale('en');
            $boostableTime['en'] = $boostableTime['en']->addDays(3)->diffForHumans($carAd->published_at);

            $boostableTime['ru'] = new Carbon(now());
            $boostableTime['ru']->setLocale('ru');
            $boostableTime['ru'] = $boostableTime['ru']->addDays(3)->diffForHumans($carAd->published_at);

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
