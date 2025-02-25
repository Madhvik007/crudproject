<x-app-layout>
    <div class="max-w-4xl mx-auto py-12">
        <!-- Back Button -->
        <div class="mb-4">
        @if(Auth::check() && Auth::user()->role === 'user')
            <a href="{{ route('posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ⬅ Back to Posts
            </a>
        @else
            <a href="{{ route('admin.posts') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                ⬅ Back to Posts
            </a>
        @endif
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" class="w-full h-64 object-cover">
            <div class="p-6">
                <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
                <p class="text-gray-600 text-sm mt-2">By {{ $post->author_name }} | {{ $post->created_at->format('M d, Y') }}</p>
                <div class="mt-6 text-gray-800">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
