<?php

namespace App\Services\LogoTiger\DTO;

use App\Services\LogoTiger\Casts\LocaleStringArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Attributes\MapFrom;

class UnitDTO extends DataTransferObject
{
    #[MapFrom('id')]
    public int $id;
    
    #[MapFrom('code')]
    public string $code;

    #[MapFrom('name')]
    #[MapTo('name')]
    #[CastWith(LocaleStringArrayCaster::class)]
    public array $name;

    #[MapFrom('itemUnits')]
    #[MapTo('item_units')]
    public ItemUnitDTO|null $item_units;
}
