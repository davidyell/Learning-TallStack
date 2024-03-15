<?php
declare(strict_types=1);

namespace App\Casters;

use App\DTOs\Over;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class OverArrayCast implements Cast
{

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return collect(array_map(static fn (array $over) => Over::from($over), $value));
    }
}
