<div class="flex w-1/4">
    <label for="group-filter" class="mt-4 mr-3">Qualifying group</label>

    <div class="relative">
        <select id="group-filter" wire:model.live="groupFilter" class="block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="">All matches</option>
            <option value="1">Group 1</option>
            <option value="2">Group 2</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
    </div>
</div>
