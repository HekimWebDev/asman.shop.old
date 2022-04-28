<?php

namespace App\Services\LogoTiger\Casts;

use Exception;
use Spatie\DataTransferObject\Caster;

class LocaleStringArrayCaster implements Caster
{
    public function cast(mixed $value): array
    {
        if (! is_string($value)) {
            throw new Exception("Can only cast string to array");
        }

        return [
            'tr' => $value
        ];
    }
}
