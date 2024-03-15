<?php
declare(strict_types=1);

namespace App\Casters;

use App\DTOs\Innings;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class InningsArrayCaster implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes)
    {
        return array_map(static fn (array $inning) => Innings::from($inning), $value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        try {
            return json_encode($value, JSON_THROW_ON_ERROR);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
