<?php

namespace App\Services\LogoTiger\DTO;

use App\Services\LogoTiger\Casts\TextStatusCaster;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Casters\ArrayCaster;

class ItemsDTO extends DataTransferObject
{
    #[MapFrom('id')]
    #[MapTo('item_id')]
    public int $item_id;

    #[MapFrom('status')]
    #[MapTo('status')]
    #[CastWith(TextStatusCaster::class)]
    public int $status;

    #[MapFrom('brandId')]
    #[MapTo('brand_id')]
    public int|null $brand_id;

    #[MapFrom('brand')]
    #[MapTo('brand')]
    public BrandDTO $brand;

    #[MapFrom('category')]
    #[MapTo('category')]
    public string $category;

    #[MapFrom('mainUnit')]
    #[MapTo('main_unit')]
    public string $main_unit;

    #[MapFrom('mainUnitId')]
    #[MapTo('unit_id')]
    public int $unit_id;

    #[MapFrom('salesLimitQuantity')]
    #[MapTo('sales_limit_quantity')]
    public int $sales_limit_quantity;

    #[MapFrom('code')]
    public string $code;

    #[MapFrom('name2')]
    #[MapTo('name')]
    public string $name;

    #[MapFrom('name')]
    #[MapTo('description')]
    public string $description;

    public mixed $attribute_data;

    public array $attributes = [
        'name',
        'description'
    ];

    #[MapFrom('units')]
    #[MapTo('item_units')]
    /** @var UnitDTO */
    #[CastWith(ArrayCaster::class, itemType: UnitDTO::class)]
    public array $units;

    #[MapFrom('stocks')]
    #[MapTo('stocks')]
    /** @var StockDTO */
    #[CastWith(ArrayCaster::class, itemType: StockDTO::class)]
    public array $stocks;

    #[MapFrom('barcodes')]
    /** @var BarcodeDTO */
    #[CastWith(ArrayCaster::class, itemType: BarcodeDTO::class)]
    public array $barcodes;

    public function buildAttributeData() : self
    {
        $map = [];

        foreach($this->attributes as $attr) {
            $map[$attr] = [
                'tr' => $this->{$attr}
            ];
        }

        $this->attribute_data = $map;

        return $this;
    }
}
