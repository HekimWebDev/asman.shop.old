<?php

namespace App\Services\LogoTiger\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Attributes\MapFrom;

class BrandDTO extends DataTransferObject
{
    #[MapFrom('id')]
    public int $id;
    
    #[MapFrom('code')]
    #[MapTo('code')]
    public string $code;

    #[MapFrom('name')]
    #[MapTo('name')]
    public string $name;
}
