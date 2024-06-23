@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="max-w-lg mx-auto p-8 rounded shadow bg-primary">
        <p class="text-2xl mb-6">Edit Category</p>
        <form action="{{ route('category.update', ['id' => $user->id, 'category_id' => $category->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Category Name</label>
                <input type="text" name="name" id="name" class="form-control mt-1 block w-full rounded-md shadow-sm" value="{{ old('name', $category->name) }}" required>
            </div>
            <div class="mb-4">
                <label for="color" class="block text-sm font-medium">Category Color</label>
                <input type="color" name="color" id="color" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('color', $category->color) }}" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection