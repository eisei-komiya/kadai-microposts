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
        @foreach ($categories as $category)
            {{-- default category --}}
            <a role="tab" style="color: {{ $category->color }}"
               href="{{ route('users.show', ['id' => $user->id, 'category_id' => $category->id]) }}" 
               class="tab grow flex items-center {{ (request()->route('category_id') == $category->id || (request()->route('category_id') === null && $category->id == intval($user->id)*4-3)) ? 'tab-active' : '' }}">
                {{ $category->name }}
                <div class="badge badge-neutral ml-1">{{ $postCounts->get($category->id, 0) }}</div>
                @if (Auth::id() == $user->id)
                <span class="btn-sm ml-2 items-center" href="{{ route('category.edit', ['id' => $user->id, 'category_id' => $category->id]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-1.5l-7.5 7.5a2.5 2.5 0 01-1.086.608l-3 .75a.5.5 0 01-.608-.608l.75-3a2.5 2.5 0 01.608-1.086l7.5-7.5z" />
                    </svg>
                </span>
                @endif
            </a>
        @endforeach
    </div>
@endif