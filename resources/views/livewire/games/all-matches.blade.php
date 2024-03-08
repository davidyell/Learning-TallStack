<div>
    <div class="bg-slate-200 p-4 flex">
        <x-filters.group-filter :group-filter="$groupFilter"></x-filters.group-filter>
        <x-filters.country-filter :country-filter="$countryFilter" :competing-nations="$competingNations"></x-filters.country-filter>
    </div>

    <div class="grid grid-cols-2">
        @forelse($games as $game)
            <x-games.game-summary wire:key="{{ $game->_id }}" :game="$game" :competing-nations="$competingNations"/>
        @empty
            <p class=" m-4 p-6 bg-yellow-200 font-semibold">No matches found</p>
        @endforelse
    </div>
</div>
