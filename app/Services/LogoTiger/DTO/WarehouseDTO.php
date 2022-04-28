<?php

namespace App\Services\LogoTiger\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Attributes\MapFrom;

class WarehouseDTO extends DataTransferObject
{
    #[MapFrom('id')]
    public int $id;
    
    #[MapFrom('nr')]
    #[MapTo('number')]
    public int $number;

    #[MapFrom('name')]
    #[MapTo('name')]
    public string $name;

    #[MapFrom('divisionNr')]
    #[MapTo('division_number')]
    public int $division_number;

    #[MapFrom('division')]
    #[MapTo('division')]
    public DivisionDTO|null $division;
}
