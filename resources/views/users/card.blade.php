<div class="my-4">
    <h2 class="text-4xl text-center">{{ $user->name }}</h2>
</div>
<div class="avatar relative">
    <div class="rounded-full">
        {{-- ユーザーのメールアドレスをもとにGravatarを取得して表示 --}}
        <img src="{{ Gravatar::get($user->email, ['size' => 400]) }}" alt="" class="w-40 h-40 rounded-full">
    </div>
    {{-- 画像編集ボタン --}}
    <a href="https://gravatar.com/profile/avatars" target="_blank">
    <button class="edit-button absolute bottom-2 right-2 transform -translate-x-1/3 -translate-y-1/3 bg-gray-800 text-white p-2 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-1.5l-7.5 7.5a2.5 2.5 0 01-1.086.608l-3 .75a.5.5 0 01-.608-.608l.75-3a2.5 2.5 0 01.608-1.086l7.5-7.5z" />
        </svg>
    </button>
    </a>
</div>
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')