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
        $games = Game::select(['info'])
            ->where('info.season', '=', '2021/22')
            ->orderBy('info.event.match_number', 'desc')
            ->get();

        return view('games.index', [
            'games' => $games
        ]);
    }
}
