<?php

namespace App\Services\LogoTiger\Casts;

use Spatie\DataTransferObject\Caster;

class TextStatusCaster implements Caster
{
    public function cast(mixed $value) : int
    {
        if ($value == 0) {
            return 0;
        }

        return 1;
    }
}
