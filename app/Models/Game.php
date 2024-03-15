<?php

declare(strict_types=1);

namespace App\Models;

use App\Casters\InningsArrayCaster;
use App\Casters\MatchInfoCaster;
use MongoDB\Laravel\Eloquent\Model;

class Game extends Model
{
    protected $collection = 'matches';

    protected $casts = [
        'info' => MatchInfoCaster::class,
        'innings' => InningsArrayCaster::class
    ];
}
