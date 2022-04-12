<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V2\InvokeRequest;
use App\Settings\Mobile;
use Illuminate\Http\Response;

class AppVersionController extends Controller
{
    /**
     * @param Mobile $mobile
     * @param InvokeRequest $request
     * @return Response
     */
    public function __invoke(Mobile $mobile, InvokeRequest $request): Response
    {
        // if ($mobile->app_active === false) {
        //     return response([
        //         'message' => [
        //             'tk' => 'Programmamyzy gowulandyrmagyň üstünde işleýäris, soňrak girmäge synanyşmagyňyzy haýyş edýäris',
        //             'en' => 'We are working on improvement of our application, please try entering later',
        //             'ru' => 'Мы работаем над улучшением нашего приложения, попробуйте войти позже',
        //         ],
        //         'status' => 'issue'
        //     ]);
        // } elseif ($mobile->app_version !== $request->get('version')) {
        //     return response([
        //         'message' => [
        //             'tk' => 'Programmanyň täze wersiýasy çykdy, programmany täzelemek üçin baglanyşyga eýeriň',
        //             'en' => 'A new version of the application is released, follow the link to update the app',
        //             'ru' => 'Вышла новая версия приложения, перейдите по ссылке, чтобы обновить приложение',
        //         ],
        //         'status' => 'update'
        //     ]);
        // }

        return response([
            'message' => [
                'tk' => 'Hemme zat normalny',
                'en' => 'Everything is normal',
                'ru' => 'Все нормально',
            ],
            'status' => 'none'
        ]);
    }
}
