<?php
declare(strict_types=1);

namespace App\Casters;

use App\DTOs\Delivery;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class DeliveryArrayCast implements Cast
{

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return array_map(static fn (array $delivery) => Delivery::from($delivery), $value);
    }
}
