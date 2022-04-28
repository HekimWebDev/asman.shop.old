<?php

namespace App\Services\LogoTiger\Requests;

use App\Services\LogoTiger\DTO\DivisionDTO;

trait HasDivisionsRequests
{
    public function divisionsRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('divisions');
        }
        $this->setDTO(DivisionDTO::class);
        $this->addPath('divisions');

        return $this;
    }
}
