<?php
declare(strict_types=1);

namespace App\DTOs;

use App\Casters\DeliveryArrayCast;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class Over extends Data
{

    public function __construct(
        #[MapInputName('over')]
        public int $overNumber,

        #[WithCast(DeliveryArrayCast::class)]
        /** @var Collection<int, Delivery> */
        public Collection $deliveries
    )
    {
    }
}
