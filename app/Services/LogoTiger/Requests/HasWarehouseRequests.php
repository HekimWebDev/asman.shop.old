<?php

namespace App\Services\LogoTiger\Requests;

use App\Services\LogoTiger\DTO\WarehouseDTO;
use App\Services\LogoTiger\DTO\WarehouseStockDTO;

trait HasWarehouseRequests
{
    public function warehousesRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('warehouses');
        }
        $this->setDTO(WarehouseDTO::class);
        $this->addPath('warehouses');

        return $this;
    }

    public function warehouseStockRequest(int $id) : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('warehouse-stock');
        }

        $this->setDTO(WarehouseStockDTO::class);
        $this->addPath("warehouses/{$id}/stocks");

        return $this;
    }
}
