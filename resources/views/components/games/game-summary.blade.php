<div class="game bg-gray-200 m-4" id="{{ $game->info['event']['match_number'] ?? $game->info['event']['stage'] }}">
    <div class="text-center text-blue-100 bg-blue-950 p-3">{{ \Illuminate\Support\Carbon::parse($game->info['dates'][0])->toFormattedDayDateString() }}</div>

    <div class="text-4xl grid grid-rows-1 grid-flow-col justify-evenly mt-4">
        <div class="{{ $game->info['teams'][0] !== $game->info['outcome']['winner'] ? 'text-gray-500' : '' }}">
            {{ $game->info['teams'][0] }} <span><span class="fi fi-{{ $game->getCountryCode($game->info['teams'][0]) }}"/></span>
        </div>

        <div>vs</div>

        <div class="{{ $game->info['teams'][1] !== $game->info['outcome']['winner'] ? 'text-gray-500' : '' }}">
            <span><span class="fi fi-{{ $game->getCountryCode($game->info['teams'][1]) }}"/></span> {{ $game->info['teams'][1] }}
        </div>
    </div>

    <div class="grid grid-cols-3 mt-4 p-3">
        <div class="col-span-2">
            <p class="">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 float-start">
                    <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                </svg>

                {{ $game->info['venue'] }}, {{ $game->info['city'] }}
            </p>
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 float-start">
                    <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
                </svg>

                @if(!empty($game->info['event']['group']))
                    Group {{ $game->info['event']['group'] }},
                @endif
                @if(!empty($game->info['event']['match_number']))
                    Match {{ $game->info['event']['match_number'] }}
                @endif
                @if(!empty($game->info['event']['stage']))
                    {{ $game->info['event']['stage'] }}
                @endif
            </p>
        </div>
        <div class="col-span-1">
            <a href="{{ route('games.show', $game->_id) }}" title="Match centre" class="bg-blue-950 hover:bg-blue-200 text-white hover:text-blue-900 rounded-xl p-3 float-end">Match centre</a>
        </div>
    </div>

    @if(!empty($game->info['outcome']))
        @if(!empty($game->info['event']['stage']) && $game->info['event']['stage'] === 'Semi Final')
            <div class="outcome p-3 text-center text-white font-bold bg-gray-500">
        @elseif(!empty($game->info['event']['stage']) && $game->info['event']['stage'] === 'Final')
            <div class="outcome p-3 text-center text-white font-bold bg-yellow-500">
        @else
            <div class="outcome p-3 text-center text-white font-bold bg-pink-500">
        @endif
            {{ $game->info['outcome']['winner'] }} win
            @if(!empty($game->info['outcome']['by']['wickets']))
                by {{ $game->info['outcome']['by']['wickets'] }} wickets!
            @endif
            @if(!empty($game->info['outcome']['by']['runs']))
                by {{ $game->info['outcome']['by']['runs'] }} runs!
            @endif
        </div>
    @endif
</div>
