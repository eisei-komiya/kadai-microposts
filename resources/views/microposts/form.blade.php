@if (Auth::id() == $user->id) {{--　ユーザー詳細と同じユーザーでログインしてたら表示 --}}
    <div class="mt-4">
        <form method="POST" action="{{ route('microposts.store') }}">
            @csrf
        
            <div class="form-control mt-4">
                <textarea rows="2" name="content" class="input input-bordered w-full"></textarea>
            </div>
        
            <button type="submit" class="btn btn-primary btn-block normal-case">Post</button>
        </form>
    </div>
@endif