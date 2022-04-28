<?php

namespace App\Services\LogoTiger\Requests;

trait HasExchangesRequests
{
    public function exchangesRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('exchanges');
        }

        $this->addPath('currencies/exchanges');

        return $this;
    }

    public function exchangesUpToDateRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('exchanges-uptodate');
        }

        $this->addPath('currencies/exchanges/upToday');

        return $this;
    }
}
