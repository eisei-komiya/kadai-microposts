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
    <div role="tablist" class="tabs tabs-bordered ">
        @foreach ($categories as $category)
            {{-- default category --}}
            <a role="tab" style="color: {{ $category->color }}"
               href="{{ route('users.show', ['id' => $user->id, 'category_id' => $category->id]) }}" 
               class="tab grow flex items-center relative {{ (request()->route('category_id') == $category->id || (request()->route('category_id') === null && $category->id == intval($user->id)*4-3)) ? 'tab-active' : '' }}">
                <div class="flex-grow text-center">
                    <span>{{ $category->name }}</span>
                    <div class="badge badge-neutral mx-2">{{ $postCounts->get($category->id, 0) }}</div>
                </div>
                
                @if (Auth::id() == $user->id)
                    <div class="absolute right-0 edit-button" data-category-id="{{ $category->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </div>
                @endif
            </a>
        @endforeach
    </div>
@endif
<script>
    $(document).ready(function() {
    $('.edit-button').on('click', function(event) {
        event.preventDefault();
        var categoryId = $(this).data('category-id');
        var userId = "{{ $user->id }}"; // BladeテンプレートからユーザーIDを取得
        var url = "{{ route('category.edit', ['id' => ':userId', 'category_id' => ':categoryId']) }}";
        url = url.replace(':userId', userId).replace(':categoryId', categoryId);
        window.location.href = url;
    });
});
</script>