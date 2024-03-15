<?php
declare(strict_types=1);

namespace App\DTOs;

use App\Casters\DateArrayCast;
use App\Casters\EventCast;
use App\Casters\OfficialsCast;
use App\Casters\SingulariseCast;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class MatchInfo extends Data
{

    public function __construct(
        #[MapInputName('balls_per_over')]
        public int $ballsPerOver,

        public string $city,

        #[WithCast(DateArrayCast::class)]
        /** @var array<int, CarbonImmutable> */
        public array $dates,

        #[WithCast(EventCast::class)]
        public Event $event,

        public string $gender,

        #[MapInputName('match_type')]
        public string $matchType,

        #[MapInputName('match_type_number')]
        public int $matchTypeNumber,

        #[WithCast(OfficialsCast::class)]
        public Officials $officials,

        /** @var array<string, string|array<string, string>> */
        public array $outcome,

        public int $overs,

        #[MapInputName('player_of_match')]
        #[WithCast(SingulariseCast::class)]
        public string $playerOfMatch,

        /** @var array<string, string[]>*/
        public array $players,

        /** @var array<string, array<string, string>> */
        public array $registry,

        public string $season,

        #[MapInputName('team_type')]
        public string $teamType,

        /** @var array<int, string> */
        public array $teams,

        /** array<string, string> */
        public array $toss,

        public string $venue
    )
    {
    }
}
