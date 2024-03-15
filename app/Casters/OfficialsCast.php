<?php
declare(strict_types=1);

namespace App\Casters;

use App\DTOs\Officials;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class OfficialsCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return Officials::from($value);
    }
}
