<?php
declare(strict_types=1);

namespace App\DTOs;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

/**
 * @phpstan-template Runs { batter: int, extras: int, total: int }
 */
class Delivery extends Data
{

    public function __construct(
        public string $batter,

        public string $bowler,

        #[MapInputName('non_striker')]
        public string $nonStriker,

        /** @var Runs */
        public array $runs
    )
    {
    }
}
