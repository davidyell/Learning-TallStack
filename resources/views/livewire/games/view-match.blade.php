<div>
    <div class="bg-cover bg-no-repeat bg-center" id="view-match-heading">
        <div class="bg-slate-100/75 p-5 text-center text-xl">
            <p>{{ $game->info->dates[0]->format('j M Y') }} &middot; {{ $game->info->event->name }}</p>

            <p>Group {{ $game->info->event->group }} Match {{ $game->info->event->matchNumber }}</p>

            <x-games.teams-versus :game="$game" :competing-nations="$competingNations" />

            <span class="inline-block my-4 py-3 px-6 bg-yellow-400 text-black">Result</span>

            <div class="grid grid-rows-1 grid-flow-col gap-4 text-2xl">
                <div>{{ $game->innings[0]->getFinalScore() }}</div>
                <div>{{ $game->innings[1]->getFinalScore() }}</div>
            </div>

            <x-games.win-margin :game="$game" />
        </div>
    </div>

    <div id="scorecards" class="mt-10">
        <div class="grid grid-rows-1 grid-flow-col w-full text-center">
            <div class="cursor-pointer border border-gray-300 p-2 {{ $scoreCardTeamKey === 0 ?: 'bg-blue-950 text-white' }}" wire:click="swapScorecards">{{ $game->info->teams[0] }}</div>
            <div class="cursor-pointer border border-gray-300 p-2 {{ $scoreCardTeamKey === 1 ?: 'bg-blue-950 text-white' }}" wire:click="swapScorecards">{{ $game->info->teams[1] }}</div>
        </div>

        <div id="scorecard-0" @class(['hidden' => $scoreCardTeamKey !== 0])>
            <x-games.scorecard :$game :team-index="0"/>
        </div>

        <div id="scorecard-1" @class(['hidden' => $scoreCardTeamKey !== 1])>
            <x-games.scorecard :$game :team-index="1"/>
        </div>
    </div>

    <div class="grid grid-rows-1 grid-cols-2">
        <div>
            <x-games.bowling :$game :team-index="0" @class(['hidden' => $scoreCardTeamKey !== 0])/>
            <x-games.bowling :$game :team-index="1" @class(['hidden' => $scoreCardTeamKey !== 1])/>
        </div>
        <div>
            The fall of wicket table
        </div>
    </div>

    <div id="rosters" class="grid grid-rows-1 md:grid-cols-2">
        <div>
            <x-games.team-sheet :$game :team-index="0"/>
        </div>
        <div>
            <x-games.team-sheet :$game :team-index="1"/>
        </div>
    </div>

    <div class="mt-4">
        <p><strong>Toss:</strong> {{ $game->info->toss['winner'] }} won the toss and decided to {{ $game->info->toss['decision'] }}</p>
        <p><strong>Venue:</strong> {{ $game->info->venue }}, {{ $game->info->city }}</p>
        <p><strong>Officials:</strong> {{ $game->info->officials->listOfficials() }}</p>
    </div>
</div>
