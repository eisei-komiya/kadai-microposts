@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="sm:grid sm:grid-cols-4 sm:gap-10 flex justify-between flex-wrap">
            <div></div>
            <div class="sm:col-span-2">
                {{-- 投稿一覧 --}}
                @include('microposts.microposts')
            </div>
            <div>
                {{-- 投稿フォーム --}}
                @if (Auth::id() == $user->id) {{--　ユーザー詳細と同じユーザーでログインしてたら表示 --}}
                    @include('microposts.form')
                @endif
            </div>
        </div>
    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>Welcome to the Micropost</h2>
                    {{-- ユーザー登録ページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">Sign up now!</a>
                </div>
            </div>
        </div>
    @endif
@endsection