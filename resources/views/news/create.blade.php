@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Add News</h2>

@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        <ul class="list-disc ml-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('news.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md">
    @csrf

    {{-- Title --}}
    <div>
        <label class="block font-semibold mb-1">Title</label>
        <input type="text" name="title" class="w-full border rounded p-2" placeholder="Enter news title" required>
    </div>

    {{-- Content with Generate button --}}
    <div>
        <label class="block font-semibold mb-1">Content</label>
        <div class="flex items-start space-x-2">
            <textarea id="content" name="content" rows="5"
                class="w-full border rounded p-2 flex-1" placeholder="Enter or generate news content..." required></textarea>
            <button type="button" id="generateBtn"
                class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 whitespace-nowrap">
                🪄 Generate
            </button>
        </div>
        <p id="genStatus" class="text-sm text-gray-500 mt-1"></p>
    </div>

    {{-- Status --}}
    <div>
        <label class="block font-semibold mb-1">Status</label>
        <select name="status" class="w-full border rounded p-2">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    {{-- Submit --}}
    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Save News
        </button>
    </div>
</form>

{{-- JavaScript for content generation --}}
<script>
document.getElementById('generateBtn').addEventListener('click', async () => {
    const title = document.querySelector('input[name="title"]').value.trim();
    const statusText = document.getElementById('genStatus');
    const contentField = document.getElementById('content');

    if (!title) {
        alert('Please enter a title first.');
        return;
    }

    statusText.textContent = 'Generating content... ⏳';

    try {
        // Call Laravel route for DuckDuckGo-based content generation
        const response = await fetch(`/generate-news?title=${encodeURIComponent(title)}`);
        const data = await response.json();

        if (data.content) {
            contentField.value = data.content;
            statusText.textContent = '✅ Content generated successfully!';
        } else {
            statusText.textContent = '⚠️ Could not generate content.';
        }
    } catch (error) {
        console.error(error);
        statusText.textContent = '❌ Error generating content.';
    }
});
</script>
@endsection
