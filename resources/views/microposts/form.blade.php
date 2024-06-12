<div class="mt-4 border-solid">
    <form method="POST" action="{{ route('microposts.store') }}">
        @csrf
    
        <div class="form-control mt-4">
            <textarea rows="4" name="content" class="input input-bordered h-24 w-full"></textarea>
        </div>
        
        <div class="form-control my-4">
            <label for="category" class="label text-sm">Select Category</label>
            <select id="category" name="category_id" class="select select-bordered w-full">
                @foreach ($user->categories->sortBy('id') as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary btn-block normal-case">Post</button>
    </form>
</div>
