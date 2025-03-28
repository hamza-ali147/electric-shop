<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Articles / Edit
            </h2>
            <a href="{{ route('articles.index') }}" class="bg-slate-700 text-sm rounded-md px-3 py-3 text-white">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Form for editing the article -->
                    <form action="{{ route('articles.update', $article->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- This will send a PUT request -->
                        
                        <!-- Title Field -->
                        <div>
                            <label for="title" class="text-lg font-medium">Title</label>
                            <div class="my-3">
                                <input 
                                    value="{{ old('title', $article->title) }}" 
                                    name="title" 
                                    placeholder="Enter Title" 
                                    type="text" 
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                >
                                @error('title')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Content (Text) Field -->
                        <div>
                            <label for="text" class="text-lg font-medium">Content</label>
                            <div class="my-3">
                                <textarea 
                                    name="text" 
                                    id="text" 
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg" 
                                    cols="30" 
                                    rows="10" 
                                    placeholder="Content">{{ old('text', $article->text) }}</textarea>
                                @error('text')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Author Field -->
                        <div>
                            <label for="author" class="text-lg font-medium">Author</label>
                            <div class="my-3">
                                <input 
                                    value="{{ old('author', $article->author) }}" 
                                    name="author" 
                                    placeholder="Enter Author Name" 
                                    type="text" 
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg"
                                >
                                @error('author')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button class="bg-slate-700 text-sm rounded-md px-5 py-4 text-white hover:bg-slate-600">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
