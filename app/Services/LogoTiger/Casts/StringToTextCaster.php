<?php

namespace App\Services\LogoTiger\Casts;

use Domain\Base\FieldTypes\Text;
use Exception;
use Spatie\DataTransferObject\Caster;

class StringToTextCaster implements Caster
{
    public function cast(mixed $value): Text
    {
        if (! is_string($value)) {
            throw new Exception("Can only cast string to array");
        }

        return new Text($value);
    }
}
