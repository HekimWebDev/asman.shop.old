<?php

namespace App\Services\LogoTiger\Casts;

use Exception;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Caster;

class ArrayToCollectCaster implements Caster
{
    public function cast(mixed $value): Collection
    {
        if (! is_array($value)) {
            throw new Exception("Can only cast array to collection");
        }

        return collect($value);
    }
}
