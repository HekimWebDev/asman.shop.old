<?php

namespace App\Services\LogoTiger\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapFrom;

class BarcodeDTO extends DataTransferObject
{
    #[MapFrom('id')]
    public int $id;
    
    #[MapFrom('itemId')]
    public int $item_id;

    #[MapFrom('itemUnitId')]
    public int $item_unit_id;

    #[MapFrom('unitId')]
    public int $unit_id;

    #[MapFrom('barcode')]
    public string $barcode;
}
