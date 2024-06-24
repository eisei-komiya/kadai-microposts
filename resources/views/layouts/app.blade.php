<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Microposts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        @vite('resources/css/app.css')
        <script src="{{ asset('js/theme-controller.js') }}" defer></script>
    </head>

    <body class="">

        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        <div class="container mx-auto sm:px-20 md:px-28 pt-20 mb-20">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
            @if(Auth::check())
                @include('commons.post_button')
            @endif
        </div>

    </body>
</html>