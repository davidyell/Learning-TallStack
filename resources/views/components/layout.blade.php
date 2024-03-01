<!doctype html>
<html lang="html5">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title  ?? 'T20 World Cup' }}</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto">
        <x-header></x-header>

        {{ $slot }}

        <x-footer></x-footer>
    </div>
</body>
</html>
