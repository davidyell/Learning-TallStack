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
        public Collection $overs,

        /** @var array<int, array<string, string|float>> */
        public array $powerplays
    )
    {
    }

    public function sumBattersRuns(): int
    {
        return $this->overs->sum(
            fn (Over $over) => $over->deliveries->sum(
                fn (Delivery $delivery) => $delivery->runs['batter']
            )
        );
    }

    public function sumExtras(): int
    {
        return $this->overs->sum(
            fn (Over $over) => $over->deliveries->sum(
                fn (Delivery $delivery) => $delivery->runs['extras']
            )
        );
    }

    public function sumWickets(): int
    {
        return $this->overs->sum(
            fn (Over $over) => $over->deliveries->sum(
                fn (Delivery $delivery) => is_array($delivery->wickets) ? count($delivery->wickets) : 0
            )
        );
    }

    public function extrasByType()
    {
        return $this->overs->flatMap->deliveries
            ->pluck('extras')
            ->filter(fn ($ball) => $ball !== null)
            ->countBy(fn (array $extra) => array_key_first($extra));
    }

    public function getFinalScore(): string
    {
        return  ($this->sumBattersRuns() + $this->sumExtras()) . '-' . $this->sumWickets();
    }

    /**
     * @return array{ runs: int, balls: int, fours: int, sixes: int, strikeRate: float, wicketDelivery: Delivery }
     */
    public function findBatterStats(string $playerName): array
    {
        $playersDeliveries =  $this->overs->flatMap->deliveries
            ->filter(fn (Delivery $delivery) => $delivery->batter === $playerName);

        $ballsFaced = $playersDeliveries->count();

        $runsScored = $playersDeliveries
            ->filter(fn (Delivery $delivery) => $delivery->runs['batter'] > 0)
            ->pluck('runs')
            ->sum(fn (array $runs) => $runs['batter']);

        $fours = $playersDeliveries
            ->filter(fn (Delivery $delivery) => $delivery->runs['batter'] === 4)
            ->count();
        $sixes = $playersDeliveries
            ->filter(fn (Delivery $delivery) => $delivery->runs['batter'] === 6)
            ->count();

        $strikeRate = 0.0;
        if ($ballsFaced > 0) {
            $strikeRate = ($runsScored / $ballsFaced) * 100;
        }

        /** @var ?Delivery $wicketDelivery */
        $wicketDelivery = $playersDeliveries->filter(fn (Delivery $delivery) => !empty($delivery->wickets))->first();

        return [
            'runs' => $runsScored,
            'balls' => $ballsFaced,
            'fours' => $fours,
            'sixes' => $sixes,
            'strikeRate' => $strikeRate,
            'wicketDelivery' => $wicketDelivery
        ];
    }
}
