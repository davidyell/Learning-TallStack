<div class="text-4xl grid grid-rows-1 grid-flow-col justify-evenly mt-4">
    <div class="{{ $game->info->teams[0] !== $game->info->outcome['winner'] ? 'text-gray-500' : '' }}">
        {{ $game->info->teams[0] }} <span><span class="fi fi-{{ $competingNations[$game->info->teams[0]] }}"/></span>
    </div>

    <div>vs</div>

    <div class="{{ $game->info->teams[1] !== $game->info->outcome['winner'] ? 'text-gray-500' : '' }}">
        <span><span class="fi fi-{{ $competingNations[$game->info->teams[1]] }}"/></span> {{ $game->info->teams[1] }}
    </div>
</div>
