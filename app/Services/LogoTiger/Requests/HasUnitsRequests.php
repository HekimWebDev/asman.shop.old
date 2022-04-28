<?php

namespace App\Services\LogoTiger\Requests;

use App\Services\LogoTiger\DTO\UnitDTO;

trait HasUnitsRequests
{
    public function unitsRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('units');
        }

        $this->setDTO(UnitDTO::class);

        $this->addPath('units');

        return $this;
    }
}
