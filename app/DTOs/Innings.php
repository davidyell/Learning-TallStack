<?php
declare(strict_types=1);

namespace App\DTOs;

use App\Casters\OverArrayCast;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class Innings extends Data
{

    public function __construct(
        public string $team,

        #[WithCast(OverArrayCast::class)]
        /** @var Collection<int, Over> */
        public $overs,

        /** @var array<int, array<string, string|float>> */
        public array $powerplays
    )
    {
    }
}
