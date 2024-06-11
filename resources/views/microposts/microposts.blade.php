<div class="mt-4">
    @if (isset($microposts))
        <ul class="list-none">
            @foreach ($microposts as $micropost)
                <li class="flex items-start justify-between gap-x-2 mb-4">
                    <div class="flex items-start gap-x-2">
                        {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                        <a href="{{ route('users.show', $micropost->user->id) }}">
                            <div class="avatar">
                                    <div class="w-12 rounded-full">
                                        <img src="{{ Gravatar::get($micropost->user->email) }}" alt="" />
                                    </div>
                                </div>
                            </a>
                        <div>
                            <div>
                                {{-- 投稿の所有者のユーザー詳細ページへのリンク --}}
                                <a class="link link-hover text-info" href="{{ route('users.show', $micropost->user->id) }}">{{ $micropost->user->name }}</a>
                                <span class="text-muted text-gray-500">posted at {{ $micropost->created_at }}</span>
                            </div>
                            <div>
                                {{-- 投稿内容 --}}
                                <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if (!Auth::user()->is_favoriting($micropost->id))
                            {{-- お気に入りボタンのフォーム --}}
                            <form method="POST" action="{{ route('favorites.favorite', $micropost->id) }}">
                                @csrf
                                <button type="submit" class="btn-sm" 
                                    onclick="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>
                                </button>
                            </form>
                        @else
                            {{-- お気に入り解除ボタンのフォーム --}}
                            <form method="POST" action="{{ route('favorites.unfavorite', $micropost->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm" 
                                    onclick="">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="yellow" class="size-6">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                        @if (Auth::id() == $micropost->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-sm" 
                                    onclick="return confirm('Delete id = {{ $micropost->id }} ?')"  class="mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $microposts->links() }}
    @endif
</div>