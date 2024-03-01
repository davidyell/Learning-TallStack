<?php

declare(strict_types=1);

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Game extends Model
{
    protected $collection = 'matches';

    private array $countryCodes = [
        'Afghanistan' => 'af',
        'Australia' => 'au',
        'Bangladesh' => 'bd',
        'England' => 'gb-eng',
        'India' => 'in',
        'Ireland' => 'ie',
        'Namibia' => 'na',
        'Netherlands' => 'nl',
        'New Zealand' => 'nz',
        'Oman' => 'om',
        'Pakistan' => 'pk',
        'Papua New Guinea' => 'pg',
        'Scotland' => 'gb-sct',
        'South Africa' => 'za',
        'Sri Lanka' => 'lk',
        'West Indies' => 'bb',
    ];

    /**
     * Convert a country name to ISO 3166-1 alpha-2 code
     */
    public function getCountryCode(string $name): ?string
    {
        return $this->countryCodes[$name] ?? null;
    }
}
