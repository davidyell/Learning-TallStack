<?php
$innings = $game->innings[$teamIndex];
$teamName = $game->info->teams[$teamIndex];
$players = $game->info->players[$teamName];
?>

<div>
    <p class="text-lg font-semibold">{{ $teamName }}</p>
    <ul>
        @foreach($players as $player)
            <li class="border-b border-b-gray-300 py-1">{{ $player }}</li>
        @endforeach
    </ul>
</div>
