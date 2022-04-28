<?php

namespace App\Services\LogoTiger\DTO;

use App\Services\LogoTiger\Casts\LocaleStringArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\CastWith;

class CurrencyDTO extends DataTransferObject
{
    #[MapFrom('id')]
    public int $id;
    
    #[MapFrom('code')]
    #[MapTo('code')]
    public string $code;

    #[MapFrom('symbol')]
    #[MapTo('symbol')]
    public string|null $symbol;

    #[MapFrom('name')]
    #[MapTo('name')]
    #[CastWith(LocaleStringArrayCaster::class)]
    public array $name;

    #[MapFrom('activelyUsed')]
    #[MapTo('enabled')]
    public bool $enabled;
}
