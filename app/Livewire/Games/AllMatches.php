<?php

namespace App\Livewire\Games;

use App\Models\Game;
use App\Providers\CountriesProvider;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use MongoDB\Laravel\Eloquent\Builder;

class AllMatches extends Component
{
    public ?string $groupFilter = null;
    public ?string $countryFilter = null;
    public array $competingNations = [];

    public Collection $games;

    public function mount(CountriesProvider $countriesProvider)
    {
        $this->getGames();
        $this->competingNations = $countriesProvider->getCompetingNations();
    }

    public function getGames(): void
    {
        $games = Game::query()
            ->select(['info'])
            ->where('info.season', '=', '2021/22')
//            ->when($this->groupFilter !== null && $this->groupFilter !== '', fn (Builder $query, string $groupNumber) => $query->where('info.event.group', '=', $groupNumber))
//            ->when($this->countryFilter !== null, fn (Builder $query, string $country) => $query->where('info.event.teams', '=', $country))
            ->orderBy('info.event.match_number', 'desc')
            ->get();

        /**
         * Use some filtering in the Collection class, as the query builder doesn't seem to work
         */
        if ($this->groupFilter !== null && $this->groupFilter !== '') {
            $games = $games->filter(fn ($match) => !empty($match['info']['event']['group']) ? $match['info']['event']['group'] === $this->groupFilter : null);
        }

        if ($this->countryFilter !== null && $this->countryFilter !== '') {
            $games = $games->filter(fn ($match) => in_array($this->countryFilter, $match['info']['teams']));
        }

        $this->games = $games;
    }

    public function render()
    {
        $this->getGames();

        return view('livewire.games.all-matches');
    }
}
