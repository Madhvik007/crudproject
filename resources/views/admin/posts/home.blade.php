<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Latest Blog Posts</h1>
            @auth
                <a href="{{ route('admin.posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                    Create New Post
                </a>
            @endauth
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div class="group bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
                    <a href="{{ route('posts.show', $post->id) }}" class="block">
                        <img src="{{ asset('images/' . $post->image) }}" alt="Blog Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">
                                {{ $post->title }}
                            </h2>
                            <p class="text-gray-500 text-sm">By {{ $post->author_name }} | {{ $post->created_at->format('M d, Y') }}</p>
                        </div>
                    </a>

                    <!-- Edit & Delete Buttons (Only for the Author or Admin) -->
                    @auth
                        @if (Auth::user()->name === $post->author_name || Auth::user()->isAdmin())
                            <div class="p-4 pt-0 flex justify-between">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" 
                                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition-colors duration-300">
                                    Edit
                                </a>

                                <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition-colors duration-300"
                                            onclick="return confirm('Are you sure you want to delete this post?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>