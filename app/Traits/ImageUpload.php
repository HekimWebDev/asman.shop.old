<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait ImageUpload
{

    public $original;
    public $large;
    public $medium;
    public $mobile;
    public $tiny;

    public function __construct(String $folder = null)
    {
        $this->original = storage_path('app/public/original/' . $folder);
        if (!File::exists($this->original)) {
            File::makeDirectory($this->original);
        }
        $this->large = storage_path('app/public/large/' . $folder);
        if (!File::exists($this->large)) {
            File::makeDirectory($this->large);
        }
        $this->medium = storage_path('app/public/medium/' . $folder);
        if (!File::exists($this->medium)) {
            File::makeDirectory($this->medium);
        }
        $this->mobile = storage_path('app/public/mobile/' . $folder);
        if (!File::exists($this->mobile)) {
            File::makeDirectory($this->mobile);
        }
        $this->tiny = storage_path('app/public/tiny/' . $folder);
        if (!File::exists($this->tiny)) {
            File::makeDirectory($this->tiny);
        }
    }

    public function storeImage(Object $query, String $folder)
    {
        $this->__construct($folder . '/');

        $hashName = Str::random(40) . '.webp';
        $image = Image::make($query)->encode('webp');
        $image->save($this->original . $hashName, 100, 'webp')
            ->resize(860, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($this->large . $hashName, 85, 'webp')
            ->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($this->medium . $hashName, 85, 'webp')
            ->resize(420, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($this->mobile . $hashName, 85, 'webp')
            ->resize(10, null, function ($constraint) {
                $constraint->aspectRatio();
            })->blur(1)->save($this->tiny . $hashName, 85, 'webp');

        return $folder . '/' . $hashName;
    }

    public function destroyImage(String $path = null)
    {
        if (File::exists($this->original . $path)) {
            File::delete($this->original . $path);
        }
        if (File::exists($this->large . $path)) {
            File::delete($this->large . $path);
        }
        if (File::exists($this->medium . $path)) {
            File::delete($this->medium . $path);
        }
        if (File::exists($this->mobile . $path)) {
            File::delete($this->mobile . $path);
        }
        if (File::exists($this->tiny . $path)) {
            File::delete($this->tiny . $path);
        }
    }
}
