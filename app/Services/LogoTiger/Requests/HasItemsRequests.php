<?php

namespace App\Services\LogoTiger\Requests;

use App\Services\LogoTiger\DTO\ItemsDTO;

trait HasItemsRequests
{
    public function itemsRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('items');
        }

        $this->setDTO(ItemsDTO::class);
        $this->addPath('items');

        return $this;
    }
}