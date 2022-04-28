<?php

namespace App\Services\LogoTiger\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapFrom;

class ItemUnitDTO extends DataTransferObject
{
    #[MapFrom('id')]
    public int $id;
    
    #[MapFrom('unitId')]
    public int $unit_id;

    #[MapFrom('itemId')]
    public int $item_id;

    #[MapFrom('mainUnit')]
    public bool $main_unit;

    #[MapFrom('coefficient')]
    public int $coefficient;

    #[MapFrom('eActive')]
    public bool $active;

    #[MapFrom('width')]
    public int $width;

    #[MapFrom('widthUnit')]
    public string|null $width_unit;

    #[MapFrom('length')]
    public int $length;

    #[MapFrom('lengthUnit')]
    public string|null $length_unit;

    #[MapFrom('height')]
    public int $height;

    #[MapFrom('heightUnit')]
    public string|null $height_unit;

    #[MapFrom('area')]
    public int $area;

    #[MapFrom('areaUnit')]
    public string|null $area_unit;

    #[MapFrom('volume')]
    public int $volume;

    #[MapFrom('volumeUnit')]
    public string|null $volume_unit;

    #[MapFrom('weight')]
    public int $weight;

    #[MapFrom('weight')]
    public string|null $weight_unit;

    #[MapFrom('grossvolume')]
    public int $gross_volume;

    #[MapFrom('grossvolumeUnit')]
    public string|null $gross_volume_unit;

    #[MapFrom('grossweight')]
    public int $gross_weght;

    #[MapFrom('grossweightUnit')]
    public string|null $gross_weight_unit;
}
