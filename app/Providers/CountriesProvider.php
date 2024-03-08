<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CountriesProvider extends ServiceProvider
{
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

    /**
     * @return array<string, string>
     */
    public function getCompetingNations(): array
    {
        return $this->countryCodes;
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(self::class, fn() => new CountriesProvider(app()));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
