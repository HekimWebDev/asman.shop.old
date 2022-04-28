<?php

namespace App\Services\LogoTiger\Requests;

use App\Services\LogoTiger\DTO\CategoryDTO;

trait HasCategoriesRequests
{
    public function categoriesRequest() : self
    {
        if ($this->isTesting()) {
            $this->setClientWithMockData('categories');
        }

        $this->setDTO(CategoryDTO::class);
        $this->addPath('items');

        return $this;
    }
}
