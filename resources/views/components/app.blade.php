<!DOCTYPE html>
<html lang="en">
<head>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="body-card-wrap">
    <div class="body-card">
        <a
            class="logo"
            href="{{ route('home') }}"></a>

        <div class="body-card__content">
            {{ $slot  }}
        </div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
@isset($scripts)
    {{ $scripts }}
@endisset
<footer>
    Created by Juan Nicolás Murillo in a few hours
</footer>
</body>
</html>
