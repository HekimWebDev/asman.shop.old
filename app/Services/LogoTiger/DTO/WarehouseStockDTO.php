<?php

namespace App\Services\LogoTiger\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Attributes\MapFrom;

class WarehouseStockDTO extends DataTransferObject
{    
    #[MapFrom('itemId')]
    #[MapTo('inventory_id')]
    public int $inventory_id;

    #[MapFrom('warehouseId')]
    #[MapTo('warehouse_number')]
    public int $warehouse_number;
    
    #[MapFrom('onhand')]
    #[MapTo('onhand')]
    public string $onhand;

    #[MapFrom('received')]
    #[MapTo('reserved')]
    public string $reserved;

    public function getAvailable()
    {
        return $this->onhand - $this->reserved;
    }
}
