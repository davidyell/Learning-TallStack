<?php
declare(strict_types=1);

namespace App\DTOs;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class Officials extends Data
{

    public function __construct(
        #[MapInputName('match_referees')]
        /** array<int, string> */
        public array $matchReferees,

        #[MapInputName('reserve_umpires')]
        /** @var array<int, string> */
        public array $reserveUmpires,

        /** @var array<int, string> */
        public array $umpires
    )
    {
    }

    public function listOfficials(): string
    {
        return implode(', ', array_merge($this->umpires, $this->matchReferees, $this->reserveUmpires));
    }
}
