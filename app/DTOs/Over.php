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

    /**
     * A maiden over is one where no runs are conceded by the bowler, i.e. the striker
     * has not scored any runs and there have been no bowling extras (No balls or Wides).
     * It may include fielding extras (Byes, Leg byes or penalty runs).
     */
    public function isMaiden() : bool
    {
        $noRunScored = $this->deliveries
            ->filter(static fn (Delivery $delivery) => $delivery->runs === 0 && !in_array('noballs', array_keys($delivery->extras)) && !in_array('wides', array_keys($delivery->extras)))
            ->count();

        return $noRunScored === $this->deliveries->count();
    }
}
