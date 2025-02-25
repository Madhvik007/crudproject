<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Latest Blog Posts</h1>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <a href="{{ route('posts.show', $post->id) }}" class="block group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 group-hover:shadow-xl group-hover:scale-[1.02]">
                        <img src="{{ asset('images/' . $post->image) }}" alt="Blog Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">
                                {{ $post->title }}
                            </h2>
                            <p class="text-gray-500 text-sm">By {{ $post->author_name }} | {{ $post->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>