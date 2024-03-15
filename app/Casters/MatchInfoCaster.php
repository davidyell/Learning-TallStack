<?php

declare(strict_types=1);

namespace App\Casters;

use App\DTOs\MatchInfo;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class MatchInfoCaster implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes): MatchInfo
    {
        return MatchInfo::from($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        try {
            return json_encode($value, JSON_THROW_ON_ERROR);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
