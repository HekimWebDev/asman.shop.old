<?php

namespace App\Services\LogoTiger\Requests;

use App\Services\LogoTiger\DTO\CurrencyDTO;

trait HasCurrenciesRequests
{
    public function currenciesRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('currencies');
        }

        $this->setDTO(CurrencyDTO::class);
        $this->addPath('currencies');

        return $this;
    }
}