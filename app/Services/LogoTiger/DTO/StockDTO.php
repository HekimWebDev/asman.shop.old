<?php

namespace App\Services\LogoTiger\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Attributes\MapFrom;

class StockDTO extends DataTransferObject
{
    #[MapFrom('onhand')]
    public int|null $onhand;
    
    #[MapFrom('reserved')]
    #[MapTo('reserved')]
    public int|null $reserved;

    #[MapFrom('warehouse')]
    #[MapTo('warehouse')]
    public WarehouseDTO|null $warehouse;

    public function getAvailable()
    {
        return $this->onhand;
    }
}
