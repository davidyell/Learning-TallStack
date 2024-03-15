<?php

namespace App\Livewire\Games;

use App\Models\Country;
use App\Models\Game;
use Livewire\Component;

class ViewMatch extends Component
{
    /**
     * @var string[]
     */
    public array $competingNations = [];

    public Game $game;

    public int $scoreCardTeamKey = 0;

    public function mount($id, Country $country)
    {
        /** @var Game $this->game */
        $this->game = Game::query()->findOrFail($id);
        $this->competingNations = $country->getCompetingNations();
    }

    public function swapScorecards(): void
    {
        $this->scoreCardTeamKey === 0 ? $this->scoreCardTeamKey = 1 : $this->scoreCardTeamKey = 0;
    }

    public function render()
    {
        return view('livewire.games.view-match');
    }
}
