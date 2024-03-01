<x-layout>
    <div class="grid grid-cols-2">
        @foreach($games as $game)
            <x-games.game-summary :game="$game" />
        @endforeach
    </div>
</x-layout>
