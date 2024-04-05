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

    public function extrasByType(): Collection
    {
        return $this->overs->flatMap->deliveries
            ->pluck('extras')
            ->filter(fn ($ball) => $ball !== null)
            ->countBy(fn (array $extra) => array_key_first($extra));
    }

    public function getFinalRunTotal(): int
    {
        return  $this->sumBattersRuns() + $this->sumExtras();
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
            ->filter(fn (Delivery $delivery) => $delivery->batter === $playerName || $delivery->nonStriker === $playerName);

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

        /** @var Delivery|null $wicketDelivery */
        $wicketDelivery = $playersDeliveries->filter(static fn (Delivery $delivery) => !empty($delivery->wickets) && $delivery->wickets[0]['player_out'] === $playerName)->first();

        return [
            'runs' => $runsScored,
            'balls' => $ballsFaced,
            'fours' => $fours,
            'sixes' => $sixes,
            'strikeRate' => $strikeRate,
            'wicketDelivery' => $wicketDelivery
        ];
    }

    /**
     * @return array<string, array{bowler: string, ball_count: int, over_count: int, maidens: int, runs: int, wickets: int}
     */
    public function findBowlerStats(): array
    {
        $oversByBowler = [];

        foreach ($this->overs as $over) {
            foreach ($over->whoBowledThisOver() as $bowler => $balls) {
                /** @var Collection<int, Delivery> $balls */

                if (empty($oversByBowler[$bowler])) {
                    $oversByBowler[$bowler] = ['bowler' => $bowler, 'ball_count' => 0, 'over_count' => 0, 'maidens' => 0, 'runs' => 0, 'wickets' => 0];
                }

                $oversByBowler[$bowler]['ball_count'] += $balls->count();
                $oversByBowler[$bowler]['runs'] += $balls->sum(fn (Delivery $delivery) => $delivery->runs['batter']);
                $oversByBowler[$bowler]['wickets'] += $balls->sum(fn (Delivery $delivery) => is_array($delivery->wickets) ? count($delivery->wickets) : 0);

                if ($balls->count() >= 6) {
                    $oversByBowler[$bowler]['over_count'] += 1;
                }

                if ($over->isMaiden()) {
                    $oversByBowler[$bowler]['maidens'] += 1;
                }
            }
        }

        return $oversByBowler;
    }
}
