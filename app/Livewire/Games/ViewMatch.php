<?php

namespace App\Livewire\Games;

use App\Models\Country;
use App\Models\Game;
use App\Providers\CountriesProvider;
use Livewire\Component;

class ViewMatch extends Component
{
    /**
     * @var string[]
     */
    public array $competingNations = [];

    public Game $game;

    public function mount($id, Country $country)
    {
        $this->game = Game::query()->findOrFail($id);
        $this->competingNations = $country->getCompetingNations();
    }

    public function render()
    {
        return view('livewire.games.view-match');
    }
}
