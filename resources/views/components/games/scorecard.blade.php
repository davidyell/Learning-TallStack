<?php
    $innings = $game->innings[$teamIndex];
    $teamName = $game->info->teams[$teamIndex];
    $players = $game->info->players[$teamName];
?>

<div>
    <table class="table-auto w-full my-5">
        <thead>
        <tr class="border-b-2 border-gray-500 bg-gray-300">
            <th class="text-left">Batter</th>
            <th colspan="2"></th>
            <th class="text-right">Runs</th>
            <th class="text-right">Balls</th>
            <th class="text-right">4s</th>
            <th class="text-right">6s</th>
            <th class="text-right">SR</th>
        </tr>
        </thead>
        <tbody>
        @foreach($players as $player)
            <?php
                $batterStats = $innings->findBatterStats($player);
            ?>
            <tr class="border-b-2 border-gray-200">
                <td class="text-left">{{ $player }}</td>
                <td class="text-left">Caught?</td>
                <td class="text-left">Bowler?</td>
                <td class="text-right">{{ $batterStats['runs'] }}</td>
                <td class="text-right">{{ $batterStats['balls'] }}</td>
                <td class="text-right">{{ $batterStats['fours'] }}</td>
                <td class="text-right">{{ $batterStats['sixes'] }}</td>
                <td class="text-right">{{ \Illuminate\Support\Number::forHumans($batterStats['strikeRate'], 2) }}</td>
            </tr>
        @endforeach
        <tr>
            <td>Extras</td>
            <td>(extras breakdown)</td>
            <td>(extras run total)</td>
            <td colspan="5"></td>
        </tr>
        <tr class="border-t-2 border-gray-500 bg-gray-300">
            <td><strong>Total</strong></td>
            <td class="text-left">(overs)</td>
            <td></td>
            <td class="text-right">final score</td>
            <td colspan="4"></td>
        </tr>
        </tbody>
    </table>
</div>
