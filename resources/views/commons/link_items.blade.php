@if (Auth::check())
    
    {{-- ユーザー一覧ページへのリンク --}}
    <li><a class="link link-hover items-center" href="{{ route('users.index') }}">Users</a></li>
    {{-- ユーザー詳細ページへのリンク --}}
    <li><a class="link link-hover items-center" href="{{ route('users.show', Auth::user()->id) }}">{{ Auth::user()->name }}&#39;s profile</a></li>
    <div class="divider lg:hidden items-center"></div>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover items-center" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    {{-- ユーザー登録ページへのリンク --}}
    <li><a class="link link-hover items-center" href="{{ route('register') }}">Signup</a></li>
    <li class="divider lg:hidden items-center"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover items-center" href="{{ route('login') }}">Login</a></li>
@endif