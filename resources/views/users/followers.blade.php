@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-4 sm:gap-10">
        <aside class="mt-4 sm:col-span-1">
            {{-- ユーザー情報 --}}
            @include('users.card')
        </aside>
        <div class="sm:col-span-3 mt-4">
            {{-- タブ --}}
            @include('users.navtabs')
            <div class="mt-4">
                {{-- ユーザー一覧 --}}
                @include('users.users')
            </div>
        </div>
    </div>
@endsection