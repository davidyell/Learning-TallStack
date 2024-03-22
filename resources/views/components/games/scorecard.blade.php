<?php
    $innings = $game->innings[$teamIndex];
    $teamName = $game->info->teams[$teamIndex];
    $players = $game->info->players[$teamName];
?>

<div>
    <table class="table-auto w-full my-5">
        <thead>
            <tr class="border-b-2 border-gray-500 bg-gray-300">
                <th class="text-left p-1">Batter</th>
                <th colspan="2"></th>
                <th class="text-right p-1">Runs</th>
                <th class="text-right p-1">Balls</th>
                <th class="text-right p-1">4s</th>
                <th class="text-right p-1">6s</th>
                <th class="text-right p-1">SR</th>
            </tr>
        </thead>
        <tbody>
        @foreach($players as $player)
            <?php
                $batterStats = $innings->findBatterStats($player);
                if ($batterStats['balls'] === 0) {
                    continue;
                }
            ?>
            <tr class="border-b-2 border-gray-200 hover:bg-slate-100">
                <td class="text-left">{{ $player }}</td>
                <td class="text-left">
                    @if(!empty($batterStats['wicketDelivery']))
                        @if($batterStats['wicketDelivery']->wickets[0]['kind'] === 'caught')
                            c
                        @elseif($batterStats['wicketDelivery']->wickets[0]['kind'] === 'stumped')
                            st
                        @elseif($batterStats['wicketDelivery']->wickets[0]['kind'] === 'run out')
                            run-out
                        @elseif($batterStats['wicketDelivery']->wickets[0]['kind'] !== 'lbw' && $batterStats['wicketDelivery']->wickets[0]['kind'] !== 'bowled')
                            {{ $batterStats['wicketDelivery']->wickets[0]['kind'] }}
                        @endif

                        @if(!empty($batterStats['wicketDelivery']->wickets[0]['fielders']))
                            {{ $batterStats['wicketDelivery']->wickets[0]['fielders'][0]['name'] }}
                        @endif
                    @elseif($batterStats['runs'] >= 0 && $batterStats['balls'] > 0)
                        not out
                    @endif
                </td>
                <td class="text-left">
                    @if(!empty($batterStats['wicketDelivery']->bowler))
                        @if($batterStats['wicketDelivery']->wickets[0]['kind'] === 'lbw')
                            {{ $batterStats['wicketDelivery']->wickets[0]['kind'] }}
                        @else
                            b
                        @endif
                        {{ $batterStats['wicketDelivery']->bowler }}
                    @endif
                </td>
                <td class="text-right font-semibold">{{ $batterStats['runs'] }}</td>
                <td class="text-right">{{ $batterStats['balls'] }}</td>
                <td class="text-right">{{ $batterStats['fours'] }}</td>
                <td class="text-right">{{ $batterStats['sixes'] }}</td>
                <td class="text-right">{{ \Illuminate\Support\Number::forHumans($batterStats['strikeRate'], 2) }}</td>
            </tr>
        @endforeach
        <tr>
            <td>Extras</td>
            <td>
                @foreach($game->innings[$teamIndex]->extrasByType() as $type => $runs)
                    {{ $runs }} {{ $type }}
                @endforeach
            </td>
            <td></td>
            <td class="text-right">{{ $game->innings[$teamIndex]->extrasByType()->sum() }}</td>
            <td colspan="4"></td>
        </tr>
        <tr class="border-t-2 border-gray-500 bg-gray-300">
            <td class=" p-1"><strong>Total</strong></td>
            <td class="text-left font-semibold p-1">({{ $game->innings[$teamIndex]->overs->count() }} overs)</td>
            <td></td>
            <td class="text-right font-semibold p-1">{{ $game->innings[$teamIndex]->getFinalRunTotal() }}</td>
            <td colspan="4"></td>
        </tr>
        </tbody>
    </table>
</div>
