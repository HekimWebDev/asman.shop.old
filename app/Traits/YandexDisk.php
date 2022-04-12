<?php

namespace App\Traits;

use Arhitector\Yandex\Disk;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait YandexDisk
{
    public $token = 'AQAAAABW560BAAdHWuvA2c6UykTNmTk_VwO6NSM';
    public $folder;
    public $import_path = 'Выгрузка 1С/webdata';
    public $export_path = 'Загрузка 1С';
    public $import_file = 'import0_1.xml';
    public $offers_file = 'offers0_1.xml';
    public $orders_file = 'orders.xml';

    public function __construct()
    {
        $this->folder = storage_path('app/public/xml');
        File::exists($this->folder) ?: File::makeDirectory($this->folder);
    }

    public function download(string $file): string
    {
        $file = $this->folder . '/' . $file;

        !File::exists($file) ?: File::delete($file);

        return $file;
    }

    public function upload(string $content)
    {
        Storage::put('/public/xml/orders.xml', $content);

        $disk = new Disk($this->token);

        $resource = $disk->getResource($this->export_path . '/' . $this->orders_file);

        $orders_file_path = storage_path('app/public/xml/orders.xml');

        $resource->upload($orders_file_path, true);
    }

    public function openFile(string $file): string
    {
        $file = $this->folder . '/' . $file;

        return $file;
    }

    public function deleteFile(string $file)
    {
        $file = $this->folder . '/' . $file;

        !File::exists($file) ?: File::delete($file);
    }
}
