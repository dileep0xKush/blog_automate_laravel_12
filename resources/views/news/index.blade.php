@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">News Management</h2>
        <a href="{{ route('news.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add News</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse bg-white shadow-md rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-left">ID</th>
                <th class="p-3 text-left">Title</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $item)
                <tr class="border-b">
                    <td class="p-3">{{ $item->id }}</td>
                    <td class="p-3">{{ $item->title }}</td>
                    <td class="p-3">
                        <span class="{{ $item->status ? 'text-green-600' : 'text-red-600' }}">
                            {{ $item->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="p-3 text-right space-x-2">
                        <a href="{{ route('news.edit', $item->id) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600"
                                onclick="return confirm('Delete this news?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $news->links() }}
    </div>
@endsection
