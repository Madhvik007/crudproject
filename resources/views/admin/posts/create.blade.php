<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.posts.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="block mb-2">Title</label>
                    <input type="text" name="title" class="w-full border rounded p-2 mb-4" required>

                    <label class="block mb-2">Category</label>
                    <input type="text" name="category" class="w-full border rounded p-2 mb-4" required>

                    <label class="block mb-2">Content</label>
                    <textarea name="content" class="w-full border rounded p-2 mb-4" required></textarea>

                    <!-- Image Upload Field -->
                    <label class="block mb-2">Image</label>
                    <input type="file" name="image" class="w-full border rounded p-2 mb-4">

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>