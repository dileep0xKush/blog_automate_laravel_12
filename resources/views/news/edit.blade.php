@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Edit News</h2>

    <form action="{{ route('news.update', $news->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold">Title</label>
            <input type="text" name="title" value="{{ $news->title }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-semibold">Content</label>
            <textarea name="content" rows="5" class="w-full border rounded p-2" required>{{ $news->content }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="1" {{ $news->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$news->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
@endsection
