{{ $game->info->outcome['winner'] }} win
@if(!empty($game->info->outcome['by']['wickets']))
    by {{ $game->info->outcome['by']['wickets'] }} wickets!
@endif
@if(!empty($game->info->outcome['by']['runs']))
    by {{ $game->info->outcome['by']['runs'] }} runs!
@endif
