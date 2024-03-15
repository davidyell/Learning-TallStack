<?php
declare(strict_types=1);

namespace App\DTOs;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

/**
 * @phpstan-template Runs { batter: int, extras: int, total: int }
 * @phpstan-template Wicket { player_out: string, fielders: array<int, string[]>, kind: string }
 * @phpstan-template Review { decision: string, batter: string, by: string, umpire: string }
 */
class Delivery extends Data
{
    public function __construct(
        public string $batter,

        public string $bowler,

        #[MapInputName('non_striker')]
        public string $nonStriker,

        /** @var Runs */
        public array $runs,

        /** @var array<string, int> */
        public ?array $extras,

        /** @var Wicket[] */
        public ?array $wickets,

        /** @var Review */
        public ?array $review
    )
    {
    }
}
