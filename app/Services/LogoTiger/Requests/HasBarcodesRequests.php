<?php

namespace App\Services\LogoTiger\Requests;

trait HasBarcodesRequests
{
    public function barcodesRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('barcodes');
        }

        $this->addPath('barcodes');

        return $this;
    }
}