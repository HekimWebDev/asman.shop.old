<?php

namespace App\Services\LogoTiger\DTO;

use DateTimeImmutable;
use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\Attributes\DefaultCast;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Attributes\MapFrom;

class PriceDTO extends DataTransferObject
{
    #[MapFrom('id')]
    public int $id;
    
    #[MapFrom('code')]
    public string $code;

    #[MapFrom('itemId')]
    public int $item_id;

    #[MapFrom('currencyId')]
    public int $currency_id;

    #[MapFrom('price')]
    public int $price;

    #[MapFrom('priority')]
    public int $priority;

    #[MapFrom('beginTime')]
    public string $begin_time;

    #[MapFrom('endTime')]
    public string $end_time;

    #[MapFrom('divisions')]
    public array $divisions;

    #[MapFrom('active')]
    public bool $active;

    #[MapFrom('currency')]
    #[MapTo('currency')]
    public CurrencyDTO $currency;

    public function isActual()
    {
        return Carbon::parse($this->end_time)->isFuture();
    }
}
