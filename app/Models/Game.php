<?php

declare(strict_types=1);

namespace App\Models;

use App\Casters\InningsArrayCaster;
use App\Casters\MatchInfoCaster;
use App\DTOs\Innings;
use App\DTOs\MatchInfo;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property MatchInfo $info
 * @property Innings $innings
 */
class Game extends Model
{
    protected $collection = 'matches';

    protected $casts = [
        'info' => MatchInfoCaster::class,
        'innings' => InningsArrayCaster::class
    ];
}
