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
            @foreach($innings->findBowlerStats() as $bowlerStats)
            <tr class="border-b-2 border-gray-200 hover:bg-slate-100">
                <td class="text-left p-1">{{ $bowlerStats['bowler'] }}</td>
                <td class="text-right p-1">{{ $bowlerStats['over_count'] }}</td>
                <td class="text-right p-1">{{ $bowlerStats['maidens'] }}</td>
                <td class="text-right p-1">{{ $bowlerStats['runs'] }}</td>
                <td class="text-right p-1">{{ $bowlerStats['wickets'] }}</td>
                <td class="text-right p-1">
                    @if($bowlerStats['over_count'] > 0)
                        {{ \Illuminate\Support\Number::format($bowlerStats['runs'] / $bowlerStats['over_count'], 2) }}
                    @else
                        0.0
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
