<div class="mx-3">
    <label for="country-filter">Country</label>
    <select name="country-filter" wire:model.live="countryFilter">
        <option value="">All countries</option>
        @foreach($competingNations as $nation => $code)
            <option value="{{ $nation }}">{{ $nation }}</option>
        @endforeach
    </select>
</div>
