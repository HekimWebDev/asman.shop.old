<?php

namespace App\Services\LogoTiger\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Attributes\MapFrom;

class CategoryDTO extends DataTransferObject
{
//    #[MapFrom('id')]
//    public int $id;
//
//    #[MapFrom('code')]
//    #[MapTo('code')]
//    public string $code;

    #[MapFrom('category')]
    #[MapTo('category')]
    public string $name;
}
