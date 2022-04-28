<?php

namespace App\Services\LogoTiger\Requests;

use App\Services\LogoTiger\DTO\PriceDTO;

trait HasPricesRequests
{
    public function pricesRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('prices?');
        }

        $this->setDTO(PriceDTO::class);
        $this->addPath("prices");

        return $this;
    }

    public function priceByItemId(int $item) : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('prices-now');
        }

        $this->addPath("prices/now?itemId={$item}");

        return $this;
    }
}
