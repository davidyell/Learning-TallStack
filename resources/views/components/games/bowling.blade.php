<?php
$innings = $game->innings[$teamIndex];
$teamName = $game->info->teams[$teamIndex];
$players = $game->info->players[$teamName];
?>

<div {{ $attributes->merge(['class']) }}>
    <table class="table-auto w-full my-5">
        <thead>
            <tr class="border-b-2 border-gray-500 bg-gray-300">
                <th class="text-left p-1">Bowler</th>
                <th class="text-right p-1">Overs</th>
                <th class="text-right p-1">Maidens</th>
                <th class="text-right p-1">Runs</th>
                <th class="text-right p-1">Wickets</th>
                <th class="text-right p-1">Econ</th>
            </tr>
        </thead>
        <tbody>
        {{ $innings->findBowlerStats() }}
        </tbody>
    </table>
</div>
