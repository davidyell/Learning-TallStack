<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\View\View;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $games = Game::select(['info'])->get()->groupBy(['info.event.name', 'info.season']);

        return view('games.index', [
            'games' => $games->toArray()
        ]);
    }
}
