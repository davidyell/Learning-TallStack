<?php

namespace App\Livewire\Games;

use App\Models\Game;
use Livewire\Component;

class ViewMatch extends Component
{
    private $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('livewire.games.view-match', ['game' => Game::query()->findOrFail($this->id)]);
    }
}
