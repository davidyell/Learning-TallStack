<?php
declare(strict_types=1);

namespace App\DTOs;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class Event extends Data
{

    public function __construct(
        public string $name,
        #[MapInputName('match_number')]
        public string $matchNumber,
        public string $group
    )
    {
    }
}
