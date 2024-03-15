<?php

declare(strict_types=1);

namespace App\Casters;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class DateArrayCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException();
        }

        try {
            return array_map(static fn (string $date) => CarbonImmutable::parse($date), $value);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
