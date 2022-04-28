<?php

namespace App\Services\LogoTiger\Requests;

use App\Services\LogoTiger\DTO\BrandDTO;

trait HasBrandsRequests
{
    public function brandsRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('brands');
        }

        $this->setDTO(BrandDTO::class);
        $this->addPath('brands');

        return $this;
    }
}