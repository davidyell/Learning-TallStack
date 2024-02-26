<div>
    <h1>All matches</h1>
    <ul>
    @foreach($games as $tournament => $season)
        <li>
            {{ $tournament }} - {{ key($season) }}

        </li>
    @endforeach
    </ul>
</div>
