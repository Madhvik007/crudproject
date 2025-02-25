<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="block mb-2">Title</label>
                    <input type="text" name="title" value="{{ $post->title }}" class="w-full border rounded p-2 mb-4" required>
                    
                    <label class="block mb-2">Content</label>
                    <textarea name="content" class="w-full border rounded p-2 mb-4" required>{{ $post->content }}</textarea>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
