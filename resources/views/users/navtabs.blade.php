<div role="tablist" class="tabs tabs-boxed mb-5">
    {{-- ユーザー詳細タブ --}}
    <a role="tab" href="{{ route('users.show', $user->id, 1) }}" class="tab grow {{ Request::routeIs('users.show') ? 'tab-active' : '' }}">
        TimeLine
        <div class="badge badge-neutral ml-1">{{ $user->microposts_count }}</div>
    </a>
    {{-- フォロー一覧タブ --}}
    <a role="tab" href="{{ route('users.followings', $user->id) }}" class="tab grow {{ Request::routeIs('users.followings') ? 'tab-active' : '' }}">
        Followings
        <div class="badge badge-neutral ml-1">{{ $user->followings_count }}</div>
    </a>
    {{-- フォロワー一覧タブ --}}
    <a role="tab" href="{{ route('users.followers', $user->id) }}" class="tab grow {{ Request::routeIs('users.followers') ? 'tab-active' : '' }}">
        Followers
        <div class="badge badge-neutral ml-1">{{ $user->followers_count }}</div>
    </a>
    {{-- お気に入り一覧タブ --}}
    <a role="tab" href="{{ route('users.favorites', $user->id) }}" class="tab grow {{ Request::routeIs('users.favorites') ? 'tab-active' : '' }}">
        Favorites
        <div class="badge badge-neutral ml-1">{{ $user->favorites_count }}</div>
    </a>
</div>
@if (Request::routeIs('users.show'))
    <div role="tablist" class="tabs tabs-bordered">
        @foreach ($postsByCategory as $categoryCount)
            {{-- default category --}}
            <a role="tab" href="{{ route('users.show', ['id' => $user->id, 'category_id' => $categoryCount->category->id]) }}" class="tab grow {{ request()->route('category_id') == $categoryCount->category->id ? 'tab-active' : '' }}">
                {{ $categoryCount->category->name }}
                <div class="badge badge-neutral ml-1">{{ $categoryCount->count }}</div>
            </a>
        @endforeach
    </div>
@endif